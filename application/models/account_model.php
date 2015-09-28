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



  // generate random password_token
  public function gen_pass_token($email) {
    $length = 15;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $passToken = '';
    for ($i = 0; $i < $length; $i++) {
        $passToken .= $characters[rand(0, $charactersLength - 1)];
    }

    $this->encrypt_pass_token($email, $passToken);

    return $passToken;
  }

  //
  private function encrypt_pass_token($email, $passToken){
    $salt = uniqid(mt_rand(), true);
    $hash = hash('sha256', $passToken.$salt);


    $this->db->set('password_token', $hash);
    $this->db->where('username', $email);
    $this->db->update('utm_users');

    return;
  }
}
