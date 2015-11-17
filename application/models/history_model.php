<?php

class History_model extends CI_Model {

  public function get_history($type, $id){
    $this->db->select('utm_order.*');
    $this->db->select('utm_product.product_name, utm_product.price, utm_product.main_product_image');
    $this->db->from('utm_order');
    $this->db->join('utm_product', 'utm_order.product_id = utm_product.pk_id');

    if($type == "Seller"){
      $this->db->where('utm_product.user_id', $id);
    }
    else{
      $this->db->where('utm_order.user_id', $id);
    }

    $this->db->where('order_status', 1);
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
}

?>
