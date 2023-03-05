<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class User extends CI_Controller {

	public function __construct(){
        parent::__construct();

        // if (empty($this->session->userdata('nip'))) {
        //     redirect('user/login');
        // }
		$this->load->library('session');
        $this->load->model('user_model');
		$this->load->helper(array('form', 'url', 'date'));
    }

	public function login()
	{
		$this->load->view('login');
	}

	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($this->user_model->login($username, $password)) {
			$logdata = $this->user_model->login($username, $password);
			// var_dump($logdata[0]);
			$this->session->set_userdata($logdata[0]);

			if ($logdata[0]["IsAdmin"] == 1) {
				redirect('Dashboard/index');
			} else {
				redirect('Home/index');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('user/login');
	}

	// register.. password encrypt
	public function viewRegister() {
		$this->load->view('register');
	}

	public function register_submit() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$isAdmin = $this->input->post('isAdmin');
		$passwordEncrypt = md5($password);

		$this->user_model->register($username, $passwordEncrypt, $isAdmin);
		redirect('user/login');
	}
}
