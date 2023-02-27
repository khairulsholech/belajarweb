<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends CI_Model {
    public function getCheckout($id)
    {
        // ambil data dari table checkout all
        $this->db->select('checkouts.*');
        // ambil data dari table stores hanya UserID
        $this->db->select('stores.UserID');
        // ambil data dari table products hanya ProductName
        $this->db->select('products.ProductName');
        // memilih table parent untuk join
        $this->db->from('checkouts');
        // join ke table lain
        $this->db->join('products', 'products.ProductID = checkouts.ProductID');
        $this->db->join('stores', 'products.StoreID = stores.StoreID');
        // kondisi untuk persyaratan khusus data yang ingin diambil
        $this->db->where('stores.UserID', $id);
        // mengambil data dari query
        $q = $this->db->get();
        // ambil data dalam bentuk array
        return $q->result_array();
    }

    public function confirmPayment($checkId, $status)
    {
        $data = array('Status' => $status);
        return $this->db->update('Checkouts', $data, ['CheckoutID' => $checkId]);
    }

	public function insert($data)
	{
		return $this->db->insert('checkouts', $data);
	}
}
