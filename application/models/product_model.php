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

    public function view_products($owner_id){
        if($owner_id==null){
            $this->db->select('*');
            $this->db->from('utm_product');
            $this->db->limit(6);
            $this->db->order_by("date_added", "desc");
            $query = $this->db->get();
            return $query->result();
        }
        else{
            $this->db->select('*');
            $where = "(user_id='$owner_id_id')";
            $this->db->where($where);
            $this->db->limit(6);
            $this->db->order_by("date_added", "desc");
            $query = $this->db->get('utm_product');
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