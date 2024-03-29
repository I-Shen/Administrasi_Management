<?php
// defined('BASEPATH') or exit('No direct script access allowed');
class Kariyawan_ctrl extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_kariyawan');
	}
	public function index()
	{
		$title['title'] = 'HOME';
		$email = $this->session->userdata('email');
		$data_postingan['post_information'] =  $this->model_kariyawan->get_postingan();
		$data['registrasi'] = $this->model_kariyawan->get_profil($email);
		if (empty($this->session->userdata('email')) && empty($this->session->userdata('role_id'))) {
			$this->load->view('templates/Header_user', $title);
			$this->load->view('sidebar/navbar');
			$this->load->view('home_user_body', $data_postingan);
			$this->load->view('templates/Footer_user');
		} elseif ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			$this->load->view('templates/Header_user', $title);
			$this->load->view('sidebar/navbar');
			$this->load->view('home_user_body', $data_postingan);
			$this->load->view('templates/Footer_user');
		} elseif ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			redirect(base_url('index.php/Welcome/'));
		}
	}
	public function registrasi()
	{
		# code...
		$this->form_validation->set_rules('user_name', 'User name', 'trim|required', ['required' => 'User name harus di isi']);
		$this->form_validation->set_rules(
			'email',
			'email',
			'required|trim|valid_email|is_unique[registrasi.email]',
			[
				'required' => 'email harus di isi',
				'is_unique' => 'email sudah terdaftar'
			]
		);
		$this->form_validation->set_rules('password1', 'password', 'required|trim|min_length[8]|matches[password2]', [
			'required' => 'password harus di isi',
			'matches' => 'password tidak cocok!',
			'min_length' => 'PASSWORD TERLALU LEMAH'
		]);
		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]', ['required' => 'password harus di isi']);
		$this->form_validation->set_rules('no_telp', 'phone number', 'required|trim', ['required' => 'nomer telepon harus di isi']);
		$this->form_validation->set_rules('gender', 'gender', 'required|trim', ['required' => 'gender harus di pilih']);
		$this->form_validation->set_rules('umur', 'umur', 'required|trim', ['required' => 'umur harus di isi']);

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/Header_LG');
			$this->load->view('Login_body');
			$this->load->view('templates/Footer_LG');
		} else {
			$user = $this->input->post('user_name', true);
			$email = $this->input->post('email', true);
			$password = $this->input->post('password1');
			$no_telp = $this->input->post('no_telp');
			$gender = $this->input->post('gender');
			$umur = $this->input->post('umur');
			$this->model_kariyawan->insert_registrasi($user, $email, $password, $no_telp, $gender, $umur);
			redirect(base_url('index.php/Kariyawan_ctrl'));
		}
	}
	public function login()
	{
		# code...
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$registrasi = $this->model_kariyawan->cek_email($email, $password);
	}
	public function upload_cv()
	{
		$this->load->view('templates/Header');
		$this->load->view('sidebar/Sidebar');
		$this->load->view('Upload_body');
		$this->load->view('templates/Footer');
	}
	public function feed_page()
	{
		# code...
		$data['registrasi'] = $this->db->get_where('registrasi', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
			'required' => 'email required'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', [
			'required' => 'password required'
		]);
		if ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			# code...
			// $this->dashboard();
			redirect(base_url('index.php/Welcome/dashboard'));
		} elseif ($this->form_validation->run() == FALSE) {
			# code...
			$this->load->view('templates/Header_LG');
			$this->load->view('Login_body');
			$this->load->view('templates/Footer_LG');
		} else {
			# code...
			$this->login();
		}
	}
	public function job_job($keyword)
	{
		# code...
		$data_post['post_information'] = $this->model_kariyawan->get_postingan_by($keyword);
		$title['title'] = 'job appointment';
		$this->load->view('templates/Header_form', $title);
		$this->load->view('daftar_body', $data_post);
		$this->load->view('templates/Footer_form');
	}
	public function detail_informasi()
	{
		# code...
		$title['title'] = 'job appointment';
		$this->load->view('templates/Header_form', $title);
		$this->load->view('daftar_body');
		$this->load->view('templates/Footer_form');
	}
	public function main_page()
	{
		# code...
		$email = $this->session->userdata('email');
		$data['registrasi'] = $this->model_kariyawan->get_profil($email);
		if ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			$this->load->view('templates/Header_user');
			$this->load->view('sidebar/navbar');
			$this->load->view('Profil_body', $data);
			$this->load->view('templates/Footer_user');
		} elseif (empty($this->session->userdata('email')) && empty($this->session->userdata('role_id'))) {
			# code...
			redirect(base_url('index.php/Welcome/'));
		}
	}
	public function information()
	{
		# code...
		$data['post_information'] = $this->model_kariyawan->get_postingan();
		if ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			$this->load->view('templates/Header');
			$this->load->view('sidebar/Sidebar');
			$this->load->view('Profil_body', $data);
			$this->load->view('templates/Footer');
		} elseif ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			# code...
			redirect(base_url('index.php/Welcome/'));
		}
	}
}
