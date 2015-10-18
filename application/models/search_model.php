<?php

class search_model extends CI_Model {
    
    public function get_products(){
            $this->db->select('*');
            $this->db->from('utm_product');
            $query = $this->db->get();
            return $query->result();
    }
    
    public function load_category(){
        $this->db->select('*');
        $this->db->from('utm_product_category');
        $category_data = $this->db->get();
        return $category_data->result();
    }
    
    public function search_by_cat($category_id){
        $this->db->select('*');
        $this->db->from('product');
        $where = "(category_id='$category_id')";
        $this->db->where($where);
        $query = $this->db->get('product');
        return $query->result();
    }
    
    public function search_by__query($seach_Query){
        $this->db->select('*');
        $this->db->from('product');
        $where = "(product_name='$seach_Query')";
        $this->db->where($where);
        $query = $this->db->get('product');
        return $query->result();
    }
    
}

?>