<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Product extends CI_Controller {

  public function __construct(){

    parent:: __construct();
    $this->load->library('session');
    if (empty($this->session->userdata('Username')) || $this->session->userdata('IsAdmin') == 0) {
      redirect('user/login');
    }

    $this->load->model(array('product_model', 'store_model'));
    $this->load->helper(array('form', 'url', 'date'));
	$this->load->library('form_validation');
  }

	public function index()
	{

    $product = $this->product_model->getData();

    $data = array(
      'title' => 'Product',
      'page' => 'pages/product/index',
      'product' => $product
    );

		$this->load->view('theme/index', $data);
	}

  public function addProductView()
  {
	$store = $this->store_model->getData();

    $data = array(
      'title' => 'Tambah Product',
      'page' => 'pages/product/addProduct',
      'stores' => $store
    );

    $this->load->view('theme/index', $data);
  }

  public function addProduct()
  {
	$this->form_validation->set_rules('store_name', 'Store', 'required');
    $this->form_validation->set_rules('product_name', 'Product', 'required');
	$this->form_validation->set_rules('category', 'Category', 'required');
	$this->form_validation->set_rules('price', 'Price', 'required');

    $format = "%Y-%m-%d %h:%m:%s";
    $StoreID	   = $this->input->post('store_name');
    $ProductName   = $this->input->post('product_name'); // please read the below note
    $Category      = $this->input->post('category');
    $Price         = $this->input->post('price');
    $CreatedAt     = mdate($format);
    $UpdatedAt     = mdate($format);

	if ($this->form_validation->run() == FALSE && empty($_FILES['image']['name'])) {
		$this->addProductView();
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
			$this->addProductView($error);
		} else {
			$upload_data = $this->upload->data('file_name');

			$data = array(
				'StoreID' => $StoreID,
				'ProductName' => $ProductName,
				'Category' => $Category,
				'Price' => $Price,
				'Image' => $upload_data,
				'CreatedAt' => $CreatedAt,
				'UpdatedAt' => $UpdatedAt,
			);
		if ($this->product_model->insertData($data)) {
			redirect('Product/index');
		}
      }
    }
  }

  public function delete()
  {
    $id = $this->input->get('id');
    if ($this->product_model->delete($id)) {
      redirect('Product/index');
    }
  }

  public function editProduct()
  {
    $id = $this->input->post('ProductID');
		$data = $this->product_model->getProductById($id);

    echo json_encode($data);
  }

  public function edit() {

		if (empty($_FILES['image']['name'])) {
				$value = array(
					'ProductID' => $this->input->post('ProductID'),
					'ProductName' => $this->input->post('ProductName'),
					'Category' => $this->input->post('Category'),
					'Price' => $this->input->post('Price')
				);
				if($this->product_model->updateData($value)) {
					redirect('product/index');
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
							'ProductID' => $this->input->post('ProductID'),
							'ProductName' => $this->input->post('ProductName'),
							'Category' => $this->input->post('Category'),
							'Price' => $this->input->post('Price'),
							'Image' => $upload_data
						);
						if($this->product_model->updateData($value)) {
							redirect('product/index');
				}
			}
		}
	}

	public function generatePDF()
	{
		$data['products'] = $this->product_model->getData($this->session->userdata('UserID'));
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->set_option('isRemoteEnabled', TRUE);
		$this->pdf->filename = "laporan-product-list.pdf";
		$this->pdf->load_view('pages/pdf/laporan_product_list', $data);
	}
}
