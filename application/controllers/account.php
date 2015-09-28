<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Account extends CI_Controller{

  // Account controller constructor
  public function index(){

    // check whether user login
    /*if($this->session->userdata('is_logged_in')){
			redirect('home');
		}
		else{
			$this->load->view('login_view');
		}*/
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

        $this->load->model('Account_model');
				$userdata = $this->Account_model->get_user($username);

        // if user email is exist
        if($userdata['isSuccess']){
          $passToken = $this->Account_model->gen_pass_token($username);

          $subject = "Reset Password";
          $message = "<a href='".base_url()."/account/reset_link/".$userdata['id']."-".$passToken."' target='_blank'>Reset Password Link</a>";

          // send reset link to user through email
          if($this->Account_model->sendEmail($username, $subject, $message)){
            $data['message'] = "The email is sent to ".$username;
          }
          else{
            $data['message'] = "Sorry. Email cannot be sent. Please try again later.";
          }

          $this->load->view('reset_view/email_view', $data);
        }
      }
    }
    else{
      $this->load->view('reset_view/reset_view');
    }
  }

  // Handle reset link request from user
  public function reset_link($token){
    $tokenData = explode("-", $token);

    $this->load->model('Account_model');

    // If token valid
    if($this->Account_model->verify_token($tokenData, "password")){
      $this->load->view('reset_view/resetlink_view');
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

        $this->load->model('Account_model');

        $this->Account_model->change_password($password);


      }
    }
  }
}
