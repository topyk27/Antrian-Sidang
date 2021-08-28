<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Jadwal extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_jadwal");
		$this->load->model("M_setting");
		$this->load->library('form_validation');
		if(!$this->session->userdata('tkn') || $this->session->userdata('tkn')=="belum")
		{
			$row = $this->M_setting->getAll();
			if(isset($row))
			{
				$data_pa = array(
					'tkn' => $row->token,
					'nama_pa' => $row->nama_pa,
					'nama_pa_pendek' => $row->nama_pa_pendek,
				);
			}
			else
			{
				$data_pa = array(
					'tkn' => 'belum',
					'nama_pa' => 'belum',
					'nama_pa_pendek' => 'belum',
				);
			}
			$this->session->set_userdata($data_pa);
		}
	}
	
	public function ruang($ruang_sidang)
	{
		$data['data_ruangan'] = $this->M_jadwal->getRuangan();
		$data['nama_ruangan'] = $this->M_jadwal->getNamaRuangan($ruang_sidang);
		$this->load->view('antrian/masuk/index',$data);
	}

	public function getby($ruang_sidang,$jadwal_sidang)
	{
		$data['data_jadwal'] = $this->M_jadwal->getByRuangSidang($ruang_sidang,$jadwal_sidang);
		echo json_encode($data);
	}

	public function monitor_getBy($ruang_sidang,$jadwal_sidang)
	{
		$data['data_jadwal'] = $this->M_jadwal->monitor_getBy($ruang_sidang,$jadwal_sidang);
		echo json_encode($data);
	}

	public function ambil_antrian()
	{
		$this->load->view('ambil');
	}

	public function ambil_antrian_hari_ini()
	{
		$data['data_jadwal'] = $this->M_jadwal->getByToday();
		echo json_encode($data);
	}

	public function insert_antrian()
	{
		$data = $this->M_jadwal->insert_antrian();
		echo json_encode($data);
	}

	public function ubah()
	{
		$data = $this->M_jadwal->ubah();
		echo json_encode($data);
	}

	public function ubah_status()
	{
		$data = $this->M_jadwal->ubah_status();
		echo json_encode($data);
	}

	public function hapus()
	{
		$data = $this->M_jadwal->hapus();
		echo json_encode($data);
	}

	public function monitor()
	{
		$data['data_ruangan'] = $this->M_jadwal->getRuangan();
		$this->load->view('monitor',$data);
	}

	public function data_monitor()
	{
		$data = $this->M_jadwal->data_monitor();
		echo json_encode($data);
	}

	public function insert_panggilan()
	{
		echo $this->M_jadwal->insert_panggilan();
	}

	public function cek_panggilan()
	{
		echo $this->M_jadwal->cek_panggilan();
	}

	public function panggil()
	{
		echo json_encode($this->M_jadwal->panggil());
	}

	public function hapus_panggilan()
	{
		echo $this->M_jadwal->hapus_panggilan();
	}

	public function cetak()
	{
		$post = $this->input->post();
		$no_antrian = $post['no_antrian'];
		$no_antrian = sprintf("%02d",$no_antrian);
		$perkara = $post['perkara'];
		$jadwal = $post['jadwal'];
		$ruang = $post['ruang'];
		$nama_pa = $this->session->userdata('nama_pa');
		
		$var_magin_left = 10;
		try
		{
			$p = printer_open('\\\192.168.2.110\POS1');
			printer_set_option($p, PRINTER_MODE, "RAW"); // mode disobek (gak ngegulung kertas)

			//then the width
			printer_set_option( $p,PRINTER_RESOLUTION_X, 160);
			printer_start_doc($p);
			printer_start_page($p);

			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "Pengadilan Agama ".$nama_pa,50,0);

			// Header Bon
			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);

			$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
			printer_select_pen($p, $pen);
			printer_draw_text($p, "NO Antrian Sidang", 10, 50);

			$font = printer_create_font("Arial", 98, 37, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$no_antrian", 230, 30);

			$font = printer_create_font("Arial", 38, 10, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);

			$pen = printer_create_pen(PRINTER_PEN_SOLID, 1, "000000");
			printer_select_pen($p, $pen);
			printer_draw_text($p, "Ruang Sidang", 10, 130);

			$font = printer_create_font("Arial", 98, 37, PRINTER_FW_BOLD, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$ruang", 230, 110);

			$font = printer_create_font("Arial", 20, 15, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$perkara",$var_magin_left, 220);

			$font = printer_create_font("Arial", 15, 12, PRINTER_FW_NORMAL, false, false, false, 0);
			printer_select_font($p, $font);
			printer_draw_text($p, "$jadwal",$var_magin_left, 250);
			printer_draw_line($p, $var_magin_left, 270, 400, 270);

			printer_draw_text($p, "Silahkan menunggu NO antrian", $var_magin_left, 290);
			printer_draw_text($p, "Anda dipanggil kemudian", 50, 310);
			printer_draw_text($p, "masuk ke ruang sidang $ruang", 50, 330);

			printer_draw_text($p, "  ", $var_magin_left, 340);

			printer_end_page($p);
			printer_end_doc($p);
			printer_close($p);
			$response['success'] = 1;
		}
		catch(Exception $e)
		{
			$response['success'] = 0;
		}

		echo json_encode($response);
	}
}
 ?>