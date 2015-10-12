<?php
	class update_model extends CI_Model{
		// Function To Fetch All Students Record
	
	function show_user(){
		$query = $this->db->get('utm_users');
		$query_result = $query->result();
		
		return $query_result;
	}
	
// Function To Fetch Selected Student Record
	function show_user_id($data){
		$this->db->select('*');
		$this->db->from('utm_users');
		$this->db->where('pkid', $data);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
	
// Update Query For Selected Student
	function update_user_id1($id,$data){
		$this->db->where('pkid', $id);
		$this->db->update('utm_users', $data);
	}
}
?>