<?php

class Pay_item_model extends CI_Model{

  // Verify the order is valid or not
  public function verifyOrder($orderID, $userID){
    $this->db->where('pk_id', $orderID);
    $this->db->where('user_id', $userID);
    $query = $this->db->get('utm_order');

    if($query->num_rows() && $query->result_array()[0]['order_status'] == NULL){
      return true;
    }
    else{
      return false;
    }
  }

  // Get certain order data
  public function getItem($orderID){
    $this->db->select('utm_order.*');
    $this->db->select('utm_product.product_name, utm_product.price');
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

  // Get order list
  // payment true to show the order that havent been paid and vice versa
  public function getOrderList($userID, $payment = false){
    $this->db->select('utm_order.*');
    $this->db->select('utm_product.product_name, utm_product.price, utm_product.main_product_image');
    $this->db->from('utm_order');
    $this->db->join('utm_product', 'utm_order.product_id = utm_product.pk_id');
    $this->db->where('utm_order.user_id', $userID);

    if($payment){
      $this->db->where('utm_order.order_status', NULL);
    }
    else{
      $this->db->where('utm_order.order_status', 1);
    }

    $query = $this->db->get();

    if($query->num_rows()){
      $row = $query->result_array();

      $data = array();

      foreach($row as $item){
        $temp_data = array(
          'name' => $item['product_name'],
          'quantity' => $item['order_quantity'],
          'id' => $item['pk_id'],
          'price' => $item['price'],
          'image' => $item['main_product_image']
        );

        array_push($data, $temp_data);
      }

      return $data;
    }
    else{
      return null;
    }
  }

  public function getSpecificPaymentItem($paymentID){
    $this->db->select('utm_order.*');
    $this->db->select('utm_product.product_name, utm_product.price, utm_product.main_product_image');
    $this->db->from('utm_order');
    $this->db->join('utm_product', 'utm_order.product_id = utm_product.pk_id');
    $this->db->where('payment_id', $paymentID);
    $query = $this->db->get();

    return $query;
  }

  public function setPayment($paymentData){
    $this->db->insert('utm_payment', $paymentData);
    $insert_id = $this->db->insert_id();

    return  $insert_id;
  }

  public function updateOrder($orderID, $orderData){
    $this->db->where('pk_id', $orderID);
    $this->db->update('utm_order', $orderData);
  }
}
?>
