<?php

class product_model extends CI_Model {
    public function load_category(){
        $this->db->select('*');
        $this->db->from('utm_product_category');
        $category_data = $this->db->get();
        return $category_data->result();
    }

    public function inser_product($products) {
        $this->db->insert('utm_product', $products);
        return true;
    }

    public function get_product_id(){
        $higher = 0;
        $this->db->select('*');
        $query = $this->db->get('utm_product');
        foreach ($query->result() as $row){
            if($row->product_pk_id > $higher){
                $higher = $row->product_pk_id;
            }
        }
        return ($higher+1);
    }
}

?>