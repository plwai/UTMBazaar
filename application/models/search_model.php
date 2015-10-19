<?php

class search_model extends CI_Model {
    
    public function search_by_cat($category_id){
        $this->db->select('*');
        $this->db->from('utm_product');
        $where = "(category_id='$category_id')";
        $this->db->where($where);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    public function search_by__name($product_name){
        
        $this->db->like('product_name', $product_name);
        $query = $this->db->get('utm_product');
        
        return $query->result();
    }
}

?>