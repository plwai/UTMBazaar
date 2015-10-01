<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	public function check_user($email)
	{
		$this->db->where('email', $email);
		$this->db->limit(1);
		
		$query = $this->db->get('utm_users');
		
		
		if($query->num_rows()>0 )
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function add_user($data)
	{

		$this->db->insert('utm_users',$data);
	}
}
?>
