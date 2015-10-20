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

}

?>