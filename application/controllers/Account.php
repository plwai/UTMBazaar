<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();



	}
	public function index()
	{

	}
	private function generateRandomString($nbLetters)
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

	public function check_email()
	{
		$this->load->model('Account_model');
		$email=$this->input->post('email');
       	$result=$this->Account_model->check_user($email);
       	if($result==true)
       	{
			$result2['res']=1;
		}
       	else
       	{
			$result2['res']=0;
    	}
			echo json_encode($result2);
		}

	public function register()
	{
		$this->form_validation->set_rules('sirname', 'Sir Name', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('e-mail', 'Your Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|matches[e-mail]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
			if($this->form_validation->run())
			{

				$this->load->model('Account_model');
				$email  = $this->input->post('email');
				$state = $this->Account_model->check_user($email);
				$salt = $this->generateRandomString(32);
				$password = ($this->input->post('password')).$salt;
				$password = sha1($password).":".$salt;
				$data = array
				(
					'surname' 	=> $this->input->post('sirname'),
					'name' 	=> $this->input->post('name'),
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
					$this->load->view('registration_view');
				}

			}
			else
			{
				$this->load->view('registration_view');
			}
		}
		else
		{
			$this->load->view('registration_view');
		}
	}
}
