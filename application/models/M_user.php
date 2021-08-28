<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class M_user extends CI_Model
{
	
	private $table = "user";
	public $id;
	public $username;
	public $password;
	public $nama;
	public $role;
	public $ruang_sidang_id;
	public $ruangan;

	public function rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
			],
			[
				'field' => 'username',
				'label' => 'username',
				'rules' => 'callback_validate_username',
			],
			[
				'field' => 'password',
				'label' => 'password',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'Password minimal 3 karakter'),
			],
			[
				'field' => 'ruangan',
				'label' => 'ruangan',
				'rules' => 'required',
				'errors' => array('required' =>'Silahkan pilih ruangan'),
			],

		];
	}

	public function ubah_rules()
	{
		return [
			[
				'field' => 'nama',
				'label' => 'nama',
				'rules' => 'min_length[3]',
				'errors' => array('min_length' =>'%s minimal %s karakter'),
			],
			[
				'field' => 'ruangan',
				'label' => 'ruangan',
				'rules' => 'required',
				'errors' => array('required' =>'Silahkan pilih ruangan'),
			],

		];
	}

	public function isLogin()
	{
		return ($this->session->userdata('antrian_login') ? true : false);
	}

	public function login_proses()
	{
		$this->load->model('M_jadwal','M_jadwal');
		$post = $this->input->post();
		$username = $post['username'];
		$password = hash('sha512', $post['password']);
		$statement = "SELECT * FROM user WHERE username='$username' AND password='$password' LIMIT 1";
		$query = $this->db->query($statement);
		$anu = "";
		$num = [19,0,20,5,8,10,27,3,22,8,27,22,0,7,24,20,27,15,20,19,17,0];
		foreach($num as $val)
		{
			if($val == 27)
			{
				$anu = $anu." ";
			}
			else
			{
				$anu = $anu.$this->cpr($val);
			}
		}
		if($query->num_rows()==1)
		{
			foreach($query->result() as $row)
			{
				$data = array(
					'antrian_id' => $row->id,
					'antrian_username' => $row->username,
					'antrian_nama' => $row->nama,
					'antrian_role' => $row->role,
					'antrian_ruang_sidang_id' => $row->ruang_sidang_id,
					'antrian_ruangan' => $row->ruangan,
					'antrian_login' => true,
					'antrian_cpr' => ucwords($anu),
				);
			}
			if($row->role=="admin")
			{
				$data_ruangan = $this->M_jadwal->getRuangan();
				$data['antrian_list_ruangan'] = $data_ruangan;
			}
			$this->session->set_userdata($data);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function cpr($x)
	{
		$a = "a";
		for($n=0;$n<$x;$n++)
		{
			++$a;
		}
		return $a;
	}

	public function validate_username($val)
	{
		$statement = "SELECT username FROM user WHERE username = '$val' LIMIT 1 ";
		$query = $this->db->query($statement);
		if($query->num_rows()==1)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function getAll()
	{
		$statement = "SELECT * FROM user WHERE role !='admin'";
		$query = $this->db->query($statement);
		return $query->result();
	}

	public function getById($id)
	{
		return $this->db->get_where($this->table, ["id" => $id])->row();
	}

	public function tambah()
	{
		$post = $this->input->post();
		$this->username = $post['username'];
		$this->password = hash('sha512', $post['password']);
		$this->nama = $post['nama'];
		$this->role = "operator";
		$r = explode('#', $post['ruangan']);
		$this->ruang_sidang_id = $r[0];
		$this->ruangan = $r[1];
		$this->db->insert($this->table, $this);
		return $this->db->affected_rows();
	}

	public function ubah($id)
	{
		$post = $this->input->post();
		$nama = $post['nama'];
		$r = explode('#', $post['ruangan']);
		$ruang_sidang_id = $r[0];
		$ruangan = $r[1];
		$this->db->set('nama',$nama);
		$this->db->set('ruang_sidang_id',$ruang_sidang_id);
		$this->db->set('ruangan',$ruangan);
		if(!empty($post['password']))
		{
			$password = hash('sha512', $post['password']);
			$this->db->set('password',$password);
		}
		$this->db->where('id',$id);
		$this->db->update('user');
		return $this->db->affected_rows();
	}

	public function delete()
	{
		$post = $this->input->post();
		$id = $post['id'];
		return $this->db->delete($this->table, ['id'=>$id]);
	}
}
 ?>