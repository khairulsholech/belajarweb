<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Store extends CI_Controller {

	public function __construct(){

    parent:: __construct();
	
	$this->load->library('session');
	if (empty($this->session->userdata('Username')) || $this->session->userdata('IsAdmin') == 0) {
		redirect('user/login');
	  }

    $this->load->model(array('store_model', 'user_model'));
	$this->load->helper(array('form', 'url', 'date'));
	$this->load->library('form_validation');
    
  }

	public function index()
	{
		$stores = $this->store_model->getData();
		$user = $this->user_model->getUser();

		$data = array(
			'title' => 'Store',
			'page' => 'pages/store/index',
			'stores' => $stores,
			'users' => $user
		);

		$this->load->view('theme/index', $data);
	}

	public function addStoreView()
  {
	$user = $this->user_model->getUser();

	$data = array (
		'title' => 'Tambah Store',
		'page' => 'pages/store/addStore',
		'users' => $user
	);

    $this->load->view('theme/index', $data);
  }

  public function addStore()
  {
    $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required');
	$this->form_validation->set_rules('pemilik_toko', 'Pemilik Toko', 'required');
	$this->form_validation->set_rules('description', 'description', 'required');
	$this->form_validation->set_rules('lokasi_toko', 'Lokasi Toko', 'required');

    $StoreName   = $this->input->post('nama_toko');
    $UserID      = $this->input->post('pemilik_toko');
    $Description = $this->input->post('description');
    $City 		 = $this->input->post('lokasi_toko');

	if ($this->form_validation->run() == FALSE && empty($_FILES['image']['name'])) {
			$this->addStoreView();
	}
	else {

		$config = array (
			'upload_path' => './assets/img/',
			'allowed_types' => 'jpeg|jpg|png',
			'max_size' => 5000
		);

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			$error = array('error' => $this->upload->display_errors());
			$this->addStoreView($error);
		} else {
				$upload_data = $this->upload->data('file_name');

				$data = array(
					'UserID' => $UserID,
					'StoreName' => $StoreName,
					'Avatar' => $upload_data,
					'Description' => $Description,
					'City' => $City,
				);
				if ($this->store_model->insertData($data)) {
					redirect('Store/index');
		}
      }
    }
  }
 
	public function viewStore(){
		$id = $this->uri->segment(3);

		$data_store = $this->store_model->getOneData($id);

		$data = array(
			'store' => $data_store
		);

		$this->load->view('pages/store/storeview', $data);
	}

	public function delete()
  {
    $id = $this->input->get('id');
    if ($this->store_model->delete($id)) {
      redirect('Store/index');
    }
  }

  public function editStore()
  {
    $id = $this->input->post('StoreID');
	$data = $this->store_model->getStoreById($id);

    echo json_encode($data);
  }

  public function edit() {

		if (empty($_FILES['image']['name'])) {
				$value = array(
					'UserID' => $this->input->post('pemilik_toko'),
					'StoreName' => $this->input->post('nama_toko'),
					'Description' => $this->input->post('description'),
					'City' => $this->input->post('lokasi_toko'),
				);
				if($this->store_model->updateData($value)) {
					redirect('store/index');
				}
			} else {

				$config = array (
					'upload_path' => './assets/img/',
					'allowed_types' => 'jpeg|jpg|png',
					'max_size' => 5000
				);

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image')) {
						$error = array('error' => $this->upload->display_errors());
						$this->index($error);
				} else {
					$upload_data = $this->upload->data('file_name');

					$value = array(
						'UserID' => $this->input->post('pemilik_toko'),
						'StoreName' => $this->input->post('nama_toko'),
						'Avatar' => $upload_data,
						'Description' => $this->input->post('description'),
						'City' => $this->input->post('lokasi_toko'),
					);
				if($this->store_model->updateData($value)) {
					redirect('store/index');
				}
			}
		}
	}
}


