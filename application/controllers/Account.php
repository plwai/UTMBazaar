<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		

	}
	public function index()
	{
//ses		
	}
	public function generateRandomString($nbLetters)
	{
		$randString="";
		$charUniverse="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		for($i=0; $i<$nbLetters; $i++){
			$randInt=rand(0,61);
			$randChar=$charUniverse[$randInt];
			$randString=$randString.$randChar;
		}
		return $randString;
	}
	public function register()
	{
//		$this->load->library('form_validation');
//		$this->load->helper(array('Registration', 'url'));
		
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[6]');
			$this->form_validation->set_rules('e-mail', 'Your Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|matches[e-mail]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
			$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
			
			if($this->form_validation->run())
			{
//	
				$this->load->model('Account_model');
//				$this->load->view('registration_view');
				$email  = $this->input->post('email');
//				$password  = $this->input->post('password');
				$state = $this->Account_model->check_user($email);
				$salt = $this->generateRandomString(32);
				$password = ($this->input->post('password')).$salt;
				$password = sha1($password).":".$salt;
				$data = array
				(
					'username' 	=> $this->input->post('username'),
					'email' 	=> $this->input->post('email'),
					'password' 	=> $password
				);
				if($state)
				{
					
					$this->Account_model->add_user($data);
					$this->load->view('success');
				}
				else
				{
//
					$this->load->view('fail');
				}
				 
			}
			else
			{
//need to change
		$this->load->view('registration_view');
			}

		}
		else
		{ 
			$this->load->view('registration_view');
		}
	}

	
}
