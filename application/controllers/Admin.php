<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Depan extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
			$this->load->library('session');
			$this->load->helper('form');
			$this->load->helper('url');
			$this->load->helper('date');

			$this->load->database();
			$this->load->library('form_validation');

			//load the employee model
			$this->load->model('employee_model');
		$this->load->library('template');

$this->template->set_navbar('templates/navbar1');

		$this->auth();

	}
	private function auth()
	{
		if($this->session->userdata('is_logged_in'))
		{
			return TRUE;
		} else {
			redirect('user');
		}
	}
	/**
	 * Load Page Index
	 * @return [type] [description]
	 */
	public function index()
	{
		//load model
		// $this->load->model('perangkat_model');


		// $chartLaptop = $this->getChart("laptop");
		// $chartKomputer = $this->getChart("komputer");

		//parsing data to view
		// $data['laptop'] = $chartLaptop ? $chartLaptop : null;
		// $data['komputer'] = $chartKomputer ? $chartKomputer : null;

		//load template and view page
		//$this->template->set_navbar('templates/navbar');
		$this->load->view('header');
		$this->load->view('templates/navbar1');

		$this->load->view('footer');

	}
	/**
	 * Get authentication
	 * @return [type] [description]
	 */
	 function combo_check($str)
	 {
			 if ($str == '-SELECT-')
			 {
					 $this->form_validation->set_message('combo_check', 'Valid %s Name is required');
					 return FALSE;
			 }
			 else
			 {
					 return TRUE;
			 }
	 }

	 function alpha_only_space($str)
	 {
			 if (!preg_match("/^([-a-z ])+$/i", $str))
			 {
					 $this->form_validation->set_message('alpha_only_space', 'The %s field must contain only alphabets or spaces');
					 return FALSE;
			 }
			 else
			 {
					 return TRUE;
			 }
	 }

				public function tambahuser()
				{

				$this->load->view('header');
				$this->load->view('templates/navbar1');
				$data['department'] = $this->employee_model->get_hakakses();
				$data['department1'] = $this->employee_model->get_listpraktikum();

				//set validation rules
				$this->form_validation->set_rules('employeeno', 'Employee No', 'trim|required|numeric');
				$this->form_validation->set_rules('employeename', 'Employee Name', 'trim|required|xss_clean|callback_alpha_only_space');
				$this->form_validation->set_rules('employeename1', 'Employee Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('employeename2', 'Employee Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('salary', 'Salary', 'required');
				$this->form_validation->set_rules('department', 'Department', 'callback_combo_check');
				$this->form_validation->set_rules('department1', 'Department', 'callback_combo_check');


			if ($this->form_validation->run() == FALSE)
			{
				//fail validation
				$this->load->view('admin/tambahuser', $data);

				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center"></div>');

									$this->load->view('footer');
			}
			else
			{
				//pass validation
				$data = array(
						'NIM_USER' => $this->input->post('employeeno'),
						'NAMA_USER' => $this->input->post('employeename'),
						'KATASANDI_USER' => @md5($this->input->post('employeename1')),
						'EMAIL_USER' => $this->input->post('employeename2'),
						'TGLDAFTAR_USER' => @date('Y-m-d', @strtotime($this->input->post('salary'))),
						'HAKAKSES_USER' => $this->input->post('department'),
					//	'STATUS_USER' => $this->input->post('department1'),

				);

				//insert the form data into database
				$this->db->insert('user', $data);

				//display success message
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Data Berhasil Ditambahkan!!!</div>');
				$this->load->view('header');
				$this->load->view('templates/navbar1');

				redirect('admin/tambahuser');

					$this->load->view('footer');		}

				}




			}
?>
