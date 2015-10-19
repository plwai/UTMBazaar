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
    
    public function search_by__query($query){
        $this->db->select('*');
        $this->db->from('utm_product');
        $this->db->where('product_name');
        $like = "%('$query')%";
        $this->db->like($like);
        $query = $this->db->get();
        
        return $query->result();
    }
    
}

?>