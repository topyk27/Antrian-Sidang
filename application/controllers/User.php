<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class User extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_user");
		$this->load->model("M_setting");
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

	public function login()
	{
		$this->load->view('user/login');
		if($this->M_user->isLogin())
		{
			redirect('/');
		}
	}

	public function login_proses()
	{
		if($this->M_user->login_proses())
		{
			redirect('/');
		}
		else
		{
			$this->session->set_flashdata('antrian_proses_login', 'Username atau password salah.');
			redirect('user/login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user/login');
	}
}
 ?>