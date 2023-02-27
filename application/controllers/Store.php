<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends CI_Controller {

	public function __construct(){

    parent:: __construct();
	
	$this->load->library('session');
	if (empty($this->session->userdata('Username')) || $this->session->userdata('IsAdmin') == 0) {
		redirect('user/login');
	  }

    $this->load->model(array('store_model'));
    
  }

	public function index()
	{
		$stores = $this->store_model->getData();

		$data = array(
			'title' => 'Store',
			'page' => 'pages/store/index',
			'stores' => $stores
		);

		$this->load->view('theme/index', $data);
	}

	public function viewStore(){
		$id = $this->uri->segment(3);

		$data_store = $this->store_model->getOneData($id);

		$data = array(
			'store' => $data_store
		);

		$this->load->view('pages/store/storeview', $data);
	}
}


