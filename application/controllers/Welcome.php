<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_jadwal");
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

	public function index()
	{
		$data['data'] = $this->M_jadwal->getJumlahSidang();
		$this->load->view('welcome',$data);
	}
	
}
