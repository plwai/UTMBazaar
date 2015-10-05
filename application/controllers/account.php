<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Account extends CI_Controller{

  public function __construct(){
	  parent::__construct();

    $this->load->model('Account_model');
  }

  // Account controller index
  public function index(){
    // check whether user login
    if($this->session->userdata('is_logged_in')){
			redirect('home');
		}
		else{
			$this->load->view('login_view');
		}
  }

  public function check_email()
  {
	  $email=$this->input->post('email');
  	$result=$this->Account_model->get_user($email);

   	if(!$result['isSuccess'])
   	{
      $result2['res']=1;
	  }
    else
    {
	    $result2['res']=0;
    }

	  echo json_encode($result2);
  }

  /* Reset password function that will generate a link  *
   * to user's email for resetting password             */
  public function reset_password($type = ''){
    // Handle user data(username or email) sent by user
    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $this->form_validation->set_rules('email', 'Email', 'required');

      if($this->form_validation->run()){

        // Get data from reset_view form
        $username  = $this->input->post('email');

				$userdata = $this->Account_model->get_user($username);

        // if user email is exist
        if($userdata['isSuccess']){
          $passToken = $this->Account_model->gen_pass_token($username);

          $subject = "Reset Password";
          $message = "<a href='".base_url()."account/reset_link/".$userdata['id']."-".$passToken."' target='_blank'>Reset Password Link</a>";

          // send reset link to user through email
          if($this->Account_model->sendEmail($username, $subject, $message)){
            $data['message'] = "The email is sent to ".$username;
          }
          else{
            $data['message'] = "Sorry. Email cannot be sent. Please try again later.";
          }

          $this->load->view('template/header.php');
          $this->load->view('reset_view/email_view', $data);
        }
        else{
          // For security reason, we dont show the email is invalid to user
          $data['message'] = "The email is sent to ".$username;

          $this->load->view('template/header.php');
          $this->load->view('reset_view/email_view', $data);
        }
      }
    }
    else{
      $this->load->view('template/header.php');
      $this->load->view('reset_view/reset_view');
    }
  }

  // Handle reset link request from user
  public function reset_link($token){
    $tokenData = explode("-", $token);

    // If token valid
    $isValid = $this->Account_model->verify_token($tokenData, "password");

    if(!$isValid){
      $data['id'] = $tokenData[0];

      $this->load->view('template/header.php');
      $this->load->view('reset_view/resetlink_view', $data);
    }
    else if($isValid == "Expired"){
      $data['message'] = "Link expired. Please try again. Redirecting...";

      $this->load->view('template/header.php');
      $this->load->view('reset_view/email_view', $data);

      // redirect to reset password page after 5 second
      header( "refresh:5;url=".base_url()."account/reset_password");
    }
    else{
      //redirect('home');
    }

  }

  // change user password
  public function change_password(){
    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $this->form_validation->set_rules('pass', 'Password', 'required');

      if($this->form_validation->run()){
        $password = $this->input->post('pass');
        $id = $this->input->post('id');

        $salt = $this->generateRandomString(32);
        $password = ($this->input->post('password')).$salt;
        $password = sha1($password).":".$salt;



        $this->Account_model->change_password($password, $id);

        $this->load->view('template/header.php');
        $this->load->view('reset_view/reset_success');

        // redirect to home page after 5 second
        //header( "refresh:5;url=".base_url().);
      }
    }
    else{
      //redirect('home');
    }
  }

  public function register(){
    $this->form_validation->set_rules('sirname', 'Sir Name', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('e-mail', 'Your Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|matches[e-mail]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

    if($this->input->server('REQUEST_METHOD') === 'POST'){
      if($this->form_validation->run()){

      $email  = $this->input->post('email');
      $state = $this->Account_model->get_user($email);
      $salt = $this->generateRandomString(32);
      $password = ($this->input->post('password')).$salt;
      $password = sha1($password).":".$salt;
      $data = array(
            'surname' 	=> $this->input->post('sirname'),
            'name' 	=> $this->input->post('name'),
            'email' 	=> $this->input->post('email'),
            'password' 	=> $password
          );
      if(!$state['isSuccess']){
        $this->Account_model->add_user($data);
        $this->load->view('success');
      }
      else{
        $this->load->view('registration_view');
      }
      }
      else{
        $this->load->view('registration_view');
      }
    }
      else{
      $this->load->view('registration_view');
    }
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
}
