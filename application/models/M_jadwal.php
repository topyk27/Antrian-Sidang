<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Makassar');
/**
 * 
 */
class M_jadwal extends CI_Model
{
	
	private $table = "jadwal";
	public $id;
	public $perkara_id;
	public $no_antrian;
	public $perkara;
	public $penggugat;
	public $tergugat;
	public $agenda;
	public $jadwal_sidang;
	public $ruang_sidang;
	public $status;
	public $datang;
	public $pihak_hadir;

	public function __construct()
	{
		parent::__construct();
		$this->config->load('antrian_config',TRUE);
	}

	public function getRuangan()
	{
		$db_sipp = $this->load->database('sipp', TRUE);
		$statement = "SELECT id, nama FROM ruangan_sidang WHERE aktif='Y' ORDER BY nama";
		$query = $db_sipp->query($statement);
		return $query->result();
	}

	public function getNamaRuangan($ruang_sidang_id)
	{
		$db_sipp = $this->load->database('sipp',TRUE);
		$statement = "SELECT nama FROM ruangan_sidang WHERE id=$ruang_sidang_id";
		$query = $db_sipp->query($statement);
		return $query->row()->nama;
	}

	public function getByRuangSidang($ruang_sidang,$jadwal_sidang)
	{
		$statement = "SELECT * FROM jadwal WHERE ruang_sidang_id = $ruang_sidang AND jadwal_sidang = '$jadwal_sidang'";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function monitor_getBy($ruang_sidang,$jadwal_sidang)
	{
		$this->db->from($this->table);
		$this->db->where('status','masuk');
		$this->db->where('jadwal_sidang',$jadwal_sidang);
		$this->db->where('ruang_sidang_id',$ruang_sidang);
		$q = $this->db->get();
		$row = $q->row();
		if(!empty($row))
		{
			$no_antrian = $row->no_antrian; //ambil antrian yg masuk
			$this->db->where('no_antrian >= ', $no_antrian);
		}
		$this->db->from($this->table);
		$this->db->order_by('no_antrian', 'asc');
		$this->db->where('ruang_sidang_id', $ruang_sidang);
		$this->db->where('jadwal_sidang',$jadwal_sidang);
		$query = $this->db->get();
		return $query->result();
	}

	public function getByToday($isPetugas = false)
	{
		// return $this->db->get_where($this->table,["jadwal_sidang"=>date("Y-m-d")]);
		$hari_ini = date("Y-m-d");
		// $hari_ini = "2022-07-04";
		$db_sipp = $this->config->item('database_sipp','antrian_config');
		if($isPetugas)
		{
			$statement = "SELECT pj.perkara_id id, p.nomor_perkara perkara, pj.ruangan_id ruang_sidang_id, pj.ruangan ruang, p.pihak1_text penggugat, p.pihak2_text tergugat, pj.tanggal_sidang tanggal_sidang, pj.agenda agenda FROM $db_sipp.perkara_jadwal_sidang AS pj, $db_sipp.perkara AS p WHERE pj.tanggal_sidang='$hari_ini' AND pj.perkara_id=p.perkara_id AND pj.perkara_id NOT IN (SELECT perkara_id FROM jadwal WHERE jadwal_sidang='$hari_ini' AND datang=1)";
		}
		else
		{
		$statement = "SELECT pj.perkara_id id, p.nomor_perkara perkara, pj.ruangan_id ruang_sidang_id, pj.ruangan ruang, p.pihak1_text penggugat, p.pihak2_text tergugat, pj.tanggal_sidang tanggal_sidang, pj.agenda agenda
		FROM $db_sipp.perkara_jadwal_sidang AS pj, $db_sipp.perkara AS p
		WHERE pj.tanggal_sidang='$hari_ini'
		AND pj.perkara_id=p.perkara_id
		AND pj.perkara_id NOT IN (SELECT perkara_id FROM jadwal WHERE jadwal_sidang='$hari_ini')";
		}
		$query = $this->db->query($statement);
		// print_r($this->db->last_query());
		return $query->result();
	}

	public function get_no_antrian($ruang_sidang_id, $jadwal_sidang)
	{
		$statement = "SELECT MAX(no_antrian) no_antrian FROM jadwal WHERE jadwal_sidang='$jadwal_sidang' AND ruang_sidang_id=$ruang_sidang_id ";
		$query = $this->db->query($statement);
		$a = $query->row();
		return (empty($a->no_antrian)) ? 1 : $a->no_antrian+1;
	}

	public function getJumlahSidang()
	{
		$jumlah_ruangan = $this->getRuangan();
		$hari_ini = date("Y-m-d");
		$db_sipp = $this->load->database('sipp', TRUE);
		foreach($jumlah_ruangan as $key=>$val)
		{
			$ruangan_id = $val->id;
			$statement = "SELECT COUNT(id) AS jumlah FROM perkara_jadwal_sidang WHERE ruangan_id=$ruangan_id AND tanggal_sidang='$hari_ini' ";
			$query = $db_sipp->query($statement);
			$jumlah_sidang = $query->row()->jumlah;
			$statement1 = "SELECT COUNT(id) AS jumlah FROM jadwal WHERE ruang_sidang_id=$ruangan_id AND jadwal_sidang='$hari_ini' ";
			$query1 = $this->db->query($statement1);
			$jumlah_ambil = $query1->row()->jumlah;

			$data[$ruangan_id] = array(
				'nama' => $val->nama,
				'jumlah_sidang' => $jumlah_sidang,
				'jumlah_ambil' => $jumlah_ambil,
				'jumlah_belum'  => $jumlah_sidang-$jumlah_ambil,
			);
		}
		return $data;
	}

	public function insert_antrian()
	{
		$post = $this->input->post();
		$yang_hadir = $post['yang_hadir'];
		if($yang_hadir=="entahlah")
		{
			$this->datang = 0;			
		}
		else
		{
			$this->datang = 1;
		}
		$udah_masuk = $this->cek_udah_masuk_antrian($post['perkara_id'],$post['jadwal_sidang']);
		if( $udah_masuk != 0)
		{
			$statement = "UPDATE jadwal SET datang=1,pihak_hadir='$yang_hadir' WHERE id=$udah_masuk";
			$this->db->query($statement);
			$respon['success'] = $this->db->affected_rows();
			$statement1 = "SELECT no_antrian, ruang_sidang FROM jadwal WHERE id=$udah_masuk";
			$query1 = $this->db->query($statement1);
			$respon['no_antrian'] = $query1->row()->no_antrian;
			$respon['ruang_sidang'] = $query1->row()->ruang_sidang;
		}
		else
		{
			$this->perkara_id = $post['perkara_id'];
			$this->perkara = $post['perkara'];
			$this->penggugat = $post['penggugat'];
			$this->tergugat = $post['tergugat'];
			$this->jadwal_sidang = $post['jadwal_sidang'];
			$this->agenda = $post['agenda'];
			$this->ruang_sidang_id = $post['ruang_sidang_id'];
			$this->ruang_sidang = $post['ruang_sidang'];
			$this->status = "belum";		
			$this->pihak_hadir = $yang_hadir;
			$this->no_antrian = $this->get_no_antrian($this->ruang_sidang_id, $this->jadwal_sidang);
			$this->db->insert($this->table,$this);
			$respon['success'] = $this->db->affected_rows();
			$respon['no_antrian'] = $this->no_antrian;
			$respon['ruang_sidang'] = $this->ruang_sidang;
		}
		return $respon;
	}

	public function cek_udah_masuk_antrian($perkara_id,$jadwal_sidang)
	{
		$statement = "SELECT id FROM jadwal WHERE perkara_id=$perkara_id AND jadwal_sidang='$jadwal_sidang' LIMIt 1";
		$query = $this->db->query($statement);
		$a = $query->row();
		return (empty($a->id)) ? 0 : $a->id;
	}

	public function ubah()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$ruang_sidang_id = $post['ruang_sidang_id'];
		$ruang_sidang = $this->getNamaRuangan($ruang_sidang_id);
		$statement = "UPDATE jadwal SET status='belum', ruang_sidang_id=$ruang_sidang_id, ruang_sidang='$ruang_sidang' WHERE id=$id ";
		$query = $this->db->query($statement);
		$respon['success'] = $this->db->affected_rows();
		return $respon;
	}

	public function ubah_status()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$ruang_sidang_id = $post['ruang_sidang_id'];
		$jadwal_sidang = date("Y-m-d");
		$statement = "UPDATE jadwal SET status='belum' WHERE ruang_sidang_id=$ruang_sidang_id AND jadwal_sidang='$jadwal_sidang'";
		$query = $this->db->query($statement);
		$statement1 = "UPDATE jadwal SET status='masuk' WHERE ruang_sidang_id=$ruang_sidang_id AND jadwal_sidang='$jadwal_sidang' AND id=$id";
		$query1 = $this->db->query($statement1);
		return $this->db->affected_rows();
	}

	public function hapus()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$statement = "DELETE FROM jadwal WHERE id=$id";
		$query = $this->db->query($statement);
		return $this->db->affected_rows();
	}

	public function data_monitor()
	{
		$hari_ini = date("Y-m-d");
		$statement = "SELECT no_antrian, perkara, ruang_sidang_id FROM jadwal WHERE jadwal_sidang='$hari_ini' AND status='masuk' ";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function insert_panggilan()
	{
		$post = $this->input->post();
		$text = $post['text'];
		$no_antrian = $post['no_antrian'];
		$ruangan = $post['ruang_sidang'];
		$data = array(
			'text' => $text,
			'created_at' => date('Y-m-d H:i:s', time()),
			'no_antrian' => $no_antrian,
			'ruangan' => $ruangan,
		);
		$this->db->insert('panggilan',$data);
		return $this->db->insert_id();
	}

	public function cek_panggilan()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$statement = "SELECT id FROM panggilan WHERE id='$id'";
		$query = $this->db->query($statement);
		return $query->num_rows() > 0 ? "belum" : "sudah";
		// return (!empty($query->result())) ? "belum" : "sudah";
	}

	public function panggil()
	{
		$statement = "SELECT * FROM panggilan ORDER BY created_at ASC LIMIT 1";
		$query = $this->db->query($statement);
		if(empty($query->result()))
		{
			$respon['success'] = 0;
		}
		else
		{
			$respon['success'] = 1;
			foreach($query->result() as $row)
			{
				$respon['id'] = $row->id;
				$respon['text'] = $row->text;
				$respon['no_antrian'] = $row->no_antrian;
				$respon['ruangan'] = $row->ruangan;
			}
		}
		return $respon;
	}

	public function hapus_panggilan()
	{
		$post = $this->input->post();
		$id = $post['id'];
		$statement = "DELETE FROM panggilan WHERE id=$id";
		$query = $this->db->query($statement);
		return $this->db->affected_rows();
	}
}
 ?>