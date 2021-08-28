<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Setting extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_user");
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

	public function validate_username($str)
	{
		if(!$this->M_user->validate_username($str))
		{
			$this->form_validation->set_message('validate_username', 'Username telah digunakan');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function validate_image()
	{
		$check = TRUE;
		    if ((!isset($_FILES['logo'])) || $_FILES['logo']['size'] == 0) {
		        $this->form_validation->set_message('validate_image', 'Silahkan pilih logo');
		        $check = FALSE;
		    }
		    else if (isset($_FILES['logo']) && $_FILES['logo']['size'] != 0) {
		        $allowedExts = array("png","PNG");
		        $allowedTypes = array(IMAGETYPE_PNG,);
		        $extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
		        $detectedType = exif_imagetype($_FILES['logo']['tmp_name']);
		        $type = $_FILES['logo']['type'];
		        if (!in_array($detectedType, $allowedTypes)) {
		            $this->form_validation->set_message('validate_image', 'Format logo dalam bentuk png');
		            $check = FALSE;
		        }
		        if(filesize($_FILES['logo']['tmp_name']) > 2000000) {
		            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 20MB!');
		            $check = FALSE;
		        }
		        if(!in_array($extension, $allowedExts)) {
		            $this->form_validation->set_message('validate_image', "Ekstensi {$extension} tidak dapat diunggah, gunakan png.");
		            $check = FALSE;
		        }
		    }
		    return $check;
	}

	public function user()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$this->load->view('setting/user/index');
		}
	}
	public function data_user()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$data['user'] = $this->M_user->getAll();
			echo json_encode($data);
		}
	}
	public function user_tambah()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$validation = $this->form_validation;
			$validation->set_rules($this->M_user->rules());
			if($validation->run())
			{
				$respon = $this->M_user->tambah();
				if($respon==1)
				{
					$this->session->set_flashdata('success', 'Data berhasil disimpan');
					redirect("setting/user");
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal disimpan');
					redirect("setting/user");
				}
			}
			$data['ruangan'] = $this->M_jadwal->getRuangan();
			$this->load->view('setting/user/tambah',$data);
		}
	}
	public function user_ubah($id)
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else if(!isset($id))
		{
			redirect('setting/user');
		}
		else
		{
			$user = $this->M_user;
			$validation = $this->form_validation;
			$validation->set_rules($user->ubah_rules());
			if($validation->run())
			{
				$respon = $user->ubah($id);
				if($respon==1)
				{
					$this->session->set_flashdata('success', 'Data berhasil diubah');
				}
				else
				{
					$this->session->set_flashdata('success', 'Data gagal diubah');
				}
				redirect("setting/user");
			}
			$data['user'] = $user->getById($id);
			$data['ruangan'] = $this->M_jadwal->getRuangan();
			if(!$data['user'])
			{
				$this->session->set_flashdata('success', 'Data yang anda cari tidak ada');
				redirect("setting/user");
			}
			else
			{
				$this->load->view("setting/user/ubah", $data);
			}
		}
	}
	public function user_hapus()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			echo $this->M_user->delete();
		}
	}

	public function sistem()
	{
		if(!$this->M_user->isLogin())
		{
			redirect('user/login');
		}
		else
		{
			$setting = $this->M_setting;
			$validation = $this->form_validation;
			$validation->set_rules($setting->logo_rules());
			if($validation->run())
			{
				$respon = $setting->logo_upload();
				if($respon)
				{
					redirect('setting/sistem');
				}
			}
			$this->load->view("setting/sistem");
		}
	}

	public function save_text($val)
	{
		echo $this->M_setting->save_text($val);
	}

	public function awal()
	{
		$this->session->sess_destroy();
		$this->load->view("setting/awal");
	}

	public function savetoken()
	{
		echo $this->M_setting->savetoken();
	}
}
 ?>