<?php

class product_model extends CI_Model {

    public function get_products($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('utm_product');
            $query = $this->db->get();
        }
        else{
            $this->db->select("utm_product.*,utm_users.name,utm_product_category.category_name");
            $this->db->from('utm_product');
            $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
            $this->db->join('utm_product_category','utm_product_category.pk_id = utm_product.category_id');
            $where = "(utm_product.pk_id = $product_id)";
            $this->db->where($where);
            $query = $this->db->get();
        }
        return $query;
    }
}

?>