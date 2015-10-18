<?php

class product_model extends CI_Model {

    public function view_products($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('utm_product');
            $query = $this->db->get();
        }
        else{
            $this->db->select('*');
            $this->db->where('id',$product_id);
            $query = $this->db->get('utm_product');
        }
        return $query;
    }
}

?>