<?php

class Pay_item_model extends CI_Model{

  // Verify the order is valid or not
  public function verifyOrder($orderID, $userID){
    $this->db->where('pk_id', $orderID);
    $this->db->where('user_id', $userID);
    $query = $this->db->get('utm_order');

    if($query->num_rows()){
      return true;
    }
    else{
      return false;
    }
  }

  // Get order data
  public function getItem($orderID){
    $this->db->from('utm_order');
    $this->db->join('utm_product', 'utm_order.product_id = utm_product.pk_id');
    $this->db->where('utm_order.pk_id', $orderID);

    $query = $this->db->get();

    if($query->num_rows()){
      $row = $query->result_array();

      $data = array(
        'name' => $row[0]['product_name'],
        'quantity' => $row[0]['order_quantity'],
        'id' => $row[0]['pk_id'],
        'price' => $row[0]['price']
      );

      return $data;
    }
    else{
      return null;
    }
  }
}
?>
