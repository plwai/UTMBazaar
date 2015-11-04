<?php

class Pages_model extends CI_model {

	public function __construct() {
		$this->load->database();
	}

	public function get_reviews($id) {
		$query = $this->db->get_where('utm_feedback', array('product_id' => $id));
		return $query->result_array();
	}

	public function get_products() {
		$query = $this->db->get('utm_product');
		return $query->result_array();
	}

	public function add_reviews($productId, $review, $rating, $userId) {
                $data = array(
                        'product_id' => $productId,
                        'user_id' => $userId,
			'cust_review' => $review,
			'rating' => $rating
                );
                $this->db->insert('utm_feedback', $data);
        
	}

	 public function record_count() {
        return $this->db->count_all('utm_feedback');
    }

	public function get_all_reviews($limit, $start) {
		$this->db->limit($limit, $start);
		$query = $this->db->get('utm_feedback');
                //return $query->result_array();
		 if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        
	}

	public function delete_reviews($id) {
		$this->db->where('pk_id', $id);
   		$this->db->delete('utm_feedback'); 
	}
}
?>