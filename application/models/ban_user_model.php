<?php

class ban_user_model extends CI_Model {

    public function view_user($user_id){
        
        $this->db->select('*');
        $this->db->from('utm_users');
        $query = $this->db->get();
		
        return $query;
    }
	
	public function get_dropdown()
	{
		$this->db->from('utm_users');
		$this->db->order_by('type');
		$result = $this->db->get();
		$return = array();
		if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
				$return[$row['id']] = $row['type'];
			}
		}

		return $return;
	}
	
	public function update_user($id,$data){
		$this->db->where('pk_id', $id);
		$this->db->update('utm_users', $data);
	}
	
}

?>
