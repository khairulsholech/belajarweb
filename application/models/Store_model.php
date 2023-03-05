<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_model extends CI_Model {

  public function getData(){
    $this->db->select('*, users.Username');
    $this->db->from('stores');
    $this->db->join('users', 'stores.UserID=users.UserID');
  
    $query = $this->db->get();

    return $query->result_array();
  }

  public function getOneData($id){
    $this->db->select('*');
    $this->db->from('stores');
    $this->db->where('StoreID', $id);
    $this->db->join('users', 'stores.UserID=users.UserID');
  
    $query = $this->db->get();

    return $query->row_array();
  }

	public function insertData($data)
  {
    return $this->db->insert('stores', $data);
  }

	public function delete($id)
  {
    return $this->db->update('stores', array('StoreID' => $id));
  }

  public function getStoreById($id)
  {   
      $response = array();

      $this->db->select('*');
      $this->db->where('StoreID', $id);
      $records = $this->db->get('stores');
      if ($records->num_rows() == 1) {
        $row = $records->row();
        $response = array(
            'StoreID' => $row->StoreID,
            'UserID' => $row->UserID,
            'StoreName' => $row->StoreName,
            'Avatar' => $row->Avatar,
            'Description' => $row->Description,
            'City' => $row->City
        );
    }
      return $response;
  }

  public function updateData($data)
  {
    return $this->db->update('stores', $data, array('StoreID' => $data['StoreID']));
  }
}
