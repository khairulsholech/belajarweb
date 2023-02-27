<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function login($username, $password)
    {
        $array = array('Username' => $username, 'Password' => $password);
        $this->db->select('*');
        $this->db->where($array);
        $records = $this->db->get('users');
        $response = $records->result_array();
        return $response;
    }

    public function insertData($data)
    {
        return $this->db->insert('products', $data);
    }

}