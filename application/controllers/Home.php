<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Home extends CI_Controller {

	public function __construct(){

    parent:: __construct();

    $this->load->model(array('product_model', 'checkout_model'));
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('form', 'url', 'date'));
    
  }

	public function index()
	{

		$products = $this->product_model->getData();

    $data = array(
      'title' => "Home",
      "page" => 'pages/landing/product',
			'products' => $products
    );


		$this->load->view('theme/landing', $data);
	}

	public function viewDetail()
	{
					$id = $this->uri->segment(3);

					$data_product = $this->product_model->getProductById($id);

					$data = array(
						'title' => "Checkout",
						"page" => 'pages/landing/checkout',
						'product' => $data_product
					);

					$this->load->view('theme/landing', $data);
	}

	public function checkout()
	{
		if (empty($this->session->userdata('Username')) && $this->session->userdata('IsAdmin') == 0) {
      redirect('user/login');
    }
    if (empty($_FILES['image']['name']))
    {
			$id = $this->uri->segment(3);
      redirect('Home/viewDetail/'. $id);
    }

    $config = array (
      'upload_path'    => './files/',
      'allowed_types'  => 'jpeg|jpg|png',
      'max_size'       => 5000
    );

    $this->load->library('upload', $config);
    // $this->upload->initialize($config);
		if(!$this->upload->do_upload('image')){
			$id = $this->uri->segment(3);
			redirect('Home/viewDetail/'. $id);

				} else {
					$upload_data = $this->upload->data('file_name');
					$id = $this->uri->segment(3);

					$data = array(
						'ProductID' => $id,
						'UserID' => 2,
						'CreatedAt' => date('Y-m-d H:i:s'),
						'Status' => 0,
					);
		if ($this->checkout_model->insert($data)) {
						$data1 = array(
							'title' => "Success",
							'page' => 'pages/landing/success'
						);

						$this->load->view('theme/landing', $data1);
					} 
				}
			}

  // public function checkout()
	// {
		
	// 	$this->form_validation->set_rules("file", "Bukti Upload", "required");

	// 	if ($this->form_validation->run() == false) {
	// 		$id = $this->uri->segment(3);

	// 		$data_product = $this->product_model->getProductById($id);

	// 		$data = array(
	// 			'title' => "Checkout",
	// 			"page" => 'pages/landing/checkout',
	// 			'product' => $data_product
	// 		);

	// 		$this->load->view('theme/landing', $data);
	// 	}else {
	// 		$config = array (
	// 						'upload_path'    => './files/',
	// 						'allowed_types'  => 'jpeg|jpg|png',
	// 						'max_size'       => 5000
	// 					);

  //     $this->load->library('upload', $config);

	// 		if (!$this->upload->do_upload('file')) {
	// 			$id = $this->uri->segment(3);

	// 			$data_product = $this->product_model->getProductById($id);

	// 			$data = array(
	// 				'title' => "Checkout",
	// 				"page" => 'pages/landing/checkout',
	// 				'product' => $data_product
	// 			);

	// 			$this->load->view('theme/landing', $data);
	// 		} else {

	// 			$this->upload->do_upload('file');
	// 			$upload_data = $this->upload->data('file_name');
	// 			$id = $this->uri->segment(3);

	// 			$data = array(
	// 				'ProductID' => $id,
	// 				'UserID' => 2,
	// 				'CreatedAt' => date('Y-m-d H:i:s'),
	// 				'Status' => 0
	// 			);

	// 			$this->db->insert('checkouts', $data);

	// 			$data1 = array(
	// 				'title' => "Success",
	// 				'page' => 'pages/landing/success'
	// 			);

	// 			$this->load->view('theme/landing', $data1);
	// 		}
	// 	}

	// }


}
