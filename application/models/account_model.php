<?php

class Account_model extends CI_Model{

  // Search for the user and return its data
  // Return true or false if only username passed
  public function get_user($username){
    $this->db->where('email', $username);
    $query = $this->db->get('utm_users');

    // Check the user whether exist in the database
    if($query->num_rows()){
      $row = $query->result_array();

      $data = array(
        'username'     => $row[0]['email'],
        'id'           => $row[0]['pk_id'],
        'password'     => $row[0]['password'],
		'isSuccess'    => true,
		'user_type'	   => $row[0]['user_type']
      );
    }
    else{
      $data = array(
        'isSuccess' => false
      );
    }

    return $data;
  }

  public function set_active($username){
    $now = time();
		$date = date ("Y-m-d", $now);
		$time = date ("G:i:s", $now);

    $date = $date.":".$time;

    $this->db->set('last_active', $date);
    $this->db->where('email', $username);
    $query = $this->db->update('utm_users');
  }

  //activate user account
  function verifyEmailID($key)
  {
	  $data = array('status' => 1);
	  $this->db->where('md5(email)', $key);
	  return $this->db->update('utm_users', $data);
  }

  // verify token
  // type:
  //   password
  public function get_token($id, $type){
    if($type == "password"){
      $this->db->where('pk_id', $id);
      $query = $this->db->get('utm_users');

      // verify user exist
      if($query->num_rows() == 1){
        $row = $query->result_array();

        $tstamp = $row[0]['tstamp'];
        $storedHash = $row[0]['password_token'];

        $data = array(
                    'tstamp'     => $tstamp,
                    'storedHash' => $storedHash
                );

        $this->db->set('tstamp', NULL);
        $this->db->set('password_token', NULL);
        $this->db->where('pk_id', $id);
        $this->db->update('utm_users');

        return $data;
      }
      else{
        $error = "Invalid";

        return $error;
      }
    }
  }

  // update user password in database
  public function change_password($password, $id){
    $this->db->set('password', $password);
    $this->db->set('password_token', NULL);
    $this->db->set('tstamp', NULL);
    $this->db->where('pk_id', $id);
    $this->db->update('utm_users');

    return;
  }

  // encrypt password token and save into database
  public function encrypt_pass_token($email, $passToken){

    $hash = hash('sha256', $passToken);

    // generate time stamp
    $tstamp = $_SERVER["REQUEST_TIME"];

    $this->db->set('password_token', $hash);
    $this->db->set('tstamp', $tstamp);
    $this->db->where('email', $email);
    $this->db->update('utm_users');

    return;
  }

	public function add_user($data)
	{

		$this->db->insert('utm_users',$data);
	}


	function show_user($data){
		$this->db->where('pk_id', $data);
		$query = $this->db->get('utm_users');
		$query_result = $query->result();

		return $query_result;
	}


	//show query for utm users
	function show($data){
		$this->db->select('*');
		$this->db->from('utm_users');
		$this->db->where('pk_id', $data);
		$query = $this->db->get();
		$result = $query->result();

		return $result;
	}

	// Update Query For utm users
	function update_user($id,$data){
		$this->db->where('pk_id', $id);
		$this->db->update('utm_users', $data);
	}

}
