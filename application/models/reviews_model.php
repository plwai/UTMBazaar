<?php

class reviews_model extends CI_Model {

    public function insert_review($review) {
        $this->db->insert('utm_feedback', $review);
        return true;
    }
	
	public function view_reviews($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('utm_feedback');
            $query = $this->db->get();
            return $query->result();
        }
        else{
            $this->db->select('*');
            $this->db->where('id',$product_id);
            $query = $this->db->get('utm_feedback');
            return $query->result();
        }
    }
	
	public function get_products($product_id){

            $this->db->select("utm_product.*,utm_users.email");
            $this->db->from('utm_product');
            $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
            
            $where = "(utm_product.pk_id = $product_id)";
            $this->db->where($where);
            $query = $this->db->get();
        
        return $query;
    }

}

?>