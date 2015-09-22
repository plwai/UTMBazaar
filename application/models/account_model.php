<?php

class Account_model extends CI_Model{

  // Search for the user and return its data
  // Return true or false if only username passed
  public function get_user($username, $password = ''){
    $this->db->where('username', $username);
    $query = $this->db->get('utm_users');

    // Check the user whether exist in the database
    if($query->num_rows() == 1 && $password == ''){
      $data = array(
        'isSuccess' => true
      );
    }
    else if($query->num_rows() == 1){
      $row = $query->result_array();
      $data = array(
				'isSuccess'    => true
      );
    }
    else{
      $data = array(
        'isSuccess' => false
      );
    }

    return $data;
  }
}
