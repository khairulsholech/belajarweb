<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

  public function getData(){
    $this->db->select('*, stores.StoreName');
    $this->db->from('products');
		$this->db->join('stores', 'products.StoreID = stores.StoreID');
    $this->db->where('IsDeleted', 0);

  
    $query = $this->db->get();

    return $query->result_array();
  }

  public function insertData($data)
  {
    return $this->db->insert('products', $data);
  }

  public function delete($id)
  {
    return $this->db->update('products', array('IsDeleted' => 1), array('ProductID' => $id));
  }

  public function getProductById($id)
  {   
      $response = array();

      $this->db->select('*');
      $this->db->where('ProductID', $id);
      $records = $this->db->get('products');
      if ($records->num_rows() == 1) {
        $row = $records->row();
        $response = array(
            'ProductID' => $row->ProductID,
            'ProductName' => $row->ProductName,
            'Category' => $row->Category,
            'Price' => $row->Price,
            'Image' => $row->Image
        );
    }
      return $response;
  }

  public function updateData($data)
  {
    return $this->db->update('products', $data, array('ProductID' => $data['ProductID']));
  }
}
