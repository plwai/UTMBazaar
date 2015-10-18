<?php

class product_model extends CI_Model {

    public function inser_product($products) {
        $this->db->insert('product', $products);
        return true;
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

    public function view_products($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('product');
            $query = $this->db->get();
            return $query->result();
        }
        else{
            $this->db->select('*');
            $where = "(id='$product_id')";
            $this->db->where($where);
            $query = $this->db->get('product');
            return $query->result();
        }
    }

    public function load_details($product_id){
        $this->db->select("product.*,utm_users.*,product_category.*");
        $this->db->from('product');
        $this->db->join('utm_users', 'utm_users.pkid = product.user_id');
        $this->db->join('product_category','product_category.id = product.category_id');
        $where = "(product.id = $product_id)";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_product_id(){
        $higher = 0;
        $this->db->select('*');
        $query = $this->db->get('product');
        foreach ($query->result() as $row){
            if($row->id > $higher){
                $higher = $row->id;
            }
        }
        return ($higher+1);
    }
}

?>