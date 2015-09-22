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

        if($userdata['isSuccess']){
          $data['email'] = $username;
          $this->load->view('resetlink_view', $data);
        }
      }
    }
    else{
      $this->load->view('reset_view');
    }
  }

  // Resend email to user
  private function resend_email($content){

  }
}
