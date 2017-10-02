<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('berita_model');
		$this->load->helper('text');
	}

	/**
	 * Load Page Login
	 * @return [type] [description]
	 */
	public function index()
	{
		$data['data']=$this->berita_model->tampil();
		if($this->session->userdata('is_logged_in'))
		{
			redirect('depan');
		} else
		{
			$this->template->load('front', 'user/login', $data);
		}
	}

	public function selanjutnya()
	{
		$id=$this->uri->segment(3);
		$data['data']=$this->berita_model->per_id($id);
		// $this->load->view('selanjutnya',$data);
		$this->template->load('front', 'user/selanjutnya', $data);
	}

		public function semuaberita()
		{
			$data['data']=$this->berita_model->tampil();
				// $this->load->view('selanjutnya',$data);
			$this->template->load('front', 'user/selanjutnya', $data);
		}


	/**
	 * Action to validate and process input to login
	 * @return [type] [description]
	 */
	public function login()
	{
		$data['data']=$this->berita_model->tampil();
		$this->_set_validation();

		if($this->form_validation->run() == FALSE)
		{
			$this->template->load('front', 'user/login', $data);
		} else
		{
			redirect('depan');
		}
	}

	/**
	 * Action to process logout
	 * @return [type] [description]
	 */
	public function logout()
	{
		$userdata = array('is_logged_in', 'userId', 'username', 'level');
		$this->session->unset_userdata($userdata);

		redirect('user');
	}

	/**
	 * Set validation form
	 */
	private function _set_validation()
	{
		$this->load->library('form_validation');

		$this->load->library('form_validation');
		$config = array(
	        array(
	                'field' => 'NAMA_USER',
	                'label' => 'NAMA PENGGUNA',
	                'rules' => 'required'
	        ),
	        array(
	                'field' => 'KATASANDI_USER',
	                'label' => 'PASSWORD PENGGUNA',
	                'rules' => 'required|callback_check_auth',
	        ),
		);

		$this->form_validation->set_rules($config);
	}

	/**
	 * check whether username or password match with record in table user
	 * @param  [type] $password [description]
	 * @return [type]           [description]
	 */
	public function check_auth($password)
	{
		//load model
		$this->load->model('user_model');

		//get username from input
		$username = $this->input->post('NAMA_USER');
		$password = $this->input->post('KATASANDI_USER');

		//check username and password
		$result = $this->user_model->auth($username, $password);

		if($result === FALSE)
		{
			//username and password not match or invalid, set message error validation
			$this->form_validation->set_message('check_auth', 'Invalid username or password');
            return FALSE;
		} else
		{
			//username and password match, return user data
			$userdata = array(
				'is_logged_in' => TRUE,
				'ID_USER' => $result->ID_USER,
				'NIM_USER' => $result->NIM_USER,
				'NAMA_USER' => $result->NAMA_USER,
				'HAKAKSES_USER' => $result->HAKAKSES_USER


			);

			$this->session->set_userdata($userdata);
			return TRUE;
		}
	}
}
