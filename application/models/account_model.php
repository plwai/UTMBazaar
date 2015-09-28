<?php

class Account_model extends CI_Model{

  // Search for the user and return its data
  // Return true or false if only username passed
  public function get_user($username, $password = ''){
    $this->db->where('username', $username);
    $query = $this->db->get('utm_users');

    // Check the user whether exist in the database
    if($query->num_rows() == 1 && $password == ''){
      $row = $query->result_array();

      $data = array(
        'id' => $row[0]['id'],
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

  // send email to user
  public function sendEmail($to_email, $subject, $message)
	{
    $this->load->helper('email');

		$from_email = 'pailee.wai@gmail.com';

    $this->load->library('email');

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = ''; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes


    $this->email->initialize($config);
		$this->email->set_newline("\r\n");

		//send mail
		$this->email->from($from_email, 'UTMBazaar');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
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

  // encrypt password token and save into database
  private function encrypt_pass_token($email, $passToken){
    $salt = uniqid(mt_rand(), true);
    $hash = hash('sha256', $passToken.$salt);


    $this->db->set('password_token', $hash);
    $this->db->where('username', $email);
    $this->db->update('utm_users');

    return;
  }
}
