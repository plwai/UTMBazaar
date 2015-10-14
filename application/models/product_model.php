<?php

class product_model extends CI_Model {

        public function view_productss($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('utm_product');
            $query = $this->db->get();
            return $query->row_array();
        }
        else{
            $this->db->select('*');
            $this->db->where('product_pk_id',$product_id);
            $query = $this->db->get('utm_product');
            return $query->row_array();
        }
    }


    public function load_details($product_id){
        $this->db->select("utm_product.*,utm_users.*,utm_product_category.*");
        $this->db->from('utm_product');
        $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
        $this->db->join('utm_product_category','utm_product_category.pk_id = utm_product.category_id');
        $where = "(utm_product.product_pk_id = $product_id)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }



}

?>