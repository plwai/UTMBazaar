<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Account extends CI_Controller{

  public function __construct(){
	  parent::__construct();

    $this->load->helper('captcha');
    $this->load->model('Account_model');
  }

  // Account controller index
  public function index(){
    // check whether user login
    if($this->session->userdata('is_logged_in')){
			redirect('home');
		}
		else{
      $this->login();
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
    $data['title'] = 'Reset Password';
    $data['display'] = 'display:none;';

    // Handle user data(username or email) sent by user
    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $this->form_validation->set_rules('email', 'Email', 'required');

      if($this->form_validation->run()){

        // Get data from reset_view form
        $username  = $this->input->post('email');

				$userdata = $this->Account_model->get_user($username);

        // if user email is exist
        if($userdata['isSuccess']){
          $passToken = $this->gen_pass_token($username);

          $subject = "Reset Password";
          $message = "<a href='".base_url()."account/reset_link/".$userdata['id']."-".$passToken."' target='_blank'>Reset Password Link</a>";

          // send reset link to user through email
          if($this->sendEmail($username, $subject, $message)){
            $data['message'] = "The email is sent to ".$username;
          }
          else{
            $data['message'] = "Sorry. Email cannot be sent. Please try again later.";
          }

          $this->load->view('template/header.php', $data);
          $this->load->view('reset_view/email_view', $data);

          // redirect to reset password page after 5 second
          header( "refresh:5;url=".base_url());
        }
        else{
          // For security reason, we dont show the email is invalid to user
          $data['message'] = "The email is sent to ".$username;

          $this->load->view('template/header.php', $data);
          $this->load->view('reset_view/email_view', $data);

          // redirect to reset password page after 5 second
          header( "refresh:5;url=".base_url());
        }
      }
    }
    else if($this->session->userdata('is_logged_in')){
      redirect('home');
    }
    else{
      // numeric random number for captcha
      $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
      // setting up captcha config
      $vals = array(
        'word' => $random_number,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'img_width' => 140,
        'img_height' => 32,
        'expiration' => 7200
      );

      $data['captcha'] = create_captcha($vals);
      $this->session->set_userdata('captchaWord',$data['captcha']['word']);

      if ($this->agent->is_mobile()){
        $this->load->view('mobile/template/header.php', $data);
        $this->load->view('mobile/reset_view/reset_view_mobile');
      }
      else{
        $this->load->view('template/header.php', $data);
        $this->load->view('reset_view/reset_view');
      }
    }
  }

  // Handle reset link request from user
  public function reset_link($token=""){
    if($token == ""){
      redirect('home');
    }

    $data['title'] = 'Reset Password';
    $data['display'] = 'display:none;';

    $tokenData = explode("-", $token);
    $id = $tokenData[0];
    $passToken = $tokenData[1];
    $hash = hash('sha256', $passToken);
    $currTstamp = $_SERVER["REQUEST_TIME"];
    $timeLimit = 300; // in second

    // get token data
    $storedData = $this->Account_model->get_token($id, "password");

    $tstamp = $storedData['tstamp'];

    // check time stamp
    if($currTstamp - $tstamp > $timeLimit){
      $data['message'] = "Link expired. Please try again. Redirecting in 5 second...";

      $this->load->view('template/header.php', $data);
      $this->load->view('reset_view/email_view', $data);

      // redirect to reset password page after 5 second
      header( "refresh:5;url=".base_url()."account/reset_password");
    }

    // check token
    if($storedData['storedHash'] == $hash){
      $data['id'] = $id;

      if ($this->agent->is_mobile()){
        $this->load->view('mobile/template/header', $data);
        $this->load->view('mobile/reset_view/resetlink_view_mobile');
      }
      else{
        $this->load->view('template/header.php', $data);
        $this->load->view('reset_view/resetlink_view', $data);
      }

    }
    else{
      redirect('home');
    }
  }

  // change user password
  public function change_password(){
    $data['title'] = 'Reset Password';
    $data['display'] = 'display:none;';

    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $this->form_validation->set_rules('pass', 'Password', 'required');

      if($this->form_validation->run()){
        $password = $this->input->post('pass');
        $id = $this->input->post('id');

        $salt = $this->generateRandomString(32);
        $password = $password.$salt;
        $password = sha1($password).":".$salt;

        $this->Account_model->change_password($password, $id);

        $this->load->view('template/header.php', $data);
        $this->load->view('reset_view/reset_success');

        // redirect to home page after 5 second
        header( "refresh:5;url=".base_url());
      }
    }
    else{
      redirect('home');
    }
  }

  public function register(){
    $data['title'] = 'Registration';
    $data['display'] = '';

    //set input validation rule
    $this->form_validation->set_rules('sirname', 'Sir Name', 'trim|required|min_length[1]');
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('e-mail', 'Your Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('email', 'Your Email', 'trim|required|valid_email|matches[e-mail]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

    if($this->input->server('REQUEST_METHOD') === 'POST'){
      if($this->form_validation->run()){
      //get the data post from form and validate the email
      $email  = $this->input->post('email');
      $state = $this->Account_model->get_user($email);
      //enc rule
      $salt = $this->generateRandomString(32);
      $password = ($this->input->post('password')).$salt;
      $password = sha1($password).":".$salt;

      $now = time();
      $date = date ("Y-m-d", $now);
      $time = date ("G:i:s", $now);

      $date = $date.":".$time;

      $data = array(
            'surname' 	=> $this->input->post('sirname'),
            'name' 	=> $this->input->post('name'),
            'email' 	=> $this->input->post('email'),
            'password' 	=> $password,
            'register_date' => $date,
            'last_active' => $date
            );
      //If email valid add information into database, send email verify, set session and directly to homepage.
      if(!$state['isSuccess']){
        $subject = 'Verify Your Email Address';
        $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://localhost/UTMBazaar/index.php/account/verify/' . md5($email) . '<br /><br /><br />Thanks<br />UTMBazaar Team';
        $this->sendEmail($email,$subject,$message);
        $this->Account_model->add_user($data);

        $_data = $this->Account_model->get_user($email);
        $data2 = array(
            'username'  => $_data['username'],
            'id'  => $_data['id'],
            'is_logged_in'  => true
        );

        $this->Account_model->set_active($email);
        $this->session->set_userdata($data2);

        echo "<script>window.location.href='" . base_url() . "home';
        alert('Dear user please confirm your email address in your inbox.');
        </script>";

      }
      else{
        if (!$this->agent->is_mobile()) {
            $this->load->view('template/header.php', $data);
            $this->load->view('registration_view');
        }else{
            $this->load->view('mobile/template/header.php', $data);
            $this->load->view('mobile/account_view/registration_view');
        }
      }
      }
      else{
        if (!$this->agent->is_mobile()) {
            $this->load->view('template/header.php', $data);
            $this->load->view('registration_view');
        }else{
            $this->load->view('mobile/template/header.php', $data);
            $this->load->view('mobile/account_view/registration_view');
        }
      }
    }
    else if($this->session->userdata('is_logged_in')){
      redirect('home');
    }
    else{
        if (!$this->agent->is_mobile()) {
            $this->load->view('template/header.php', $data);
            $this->load->view('registration_view');
        }else{
            $this->load->view('mobile/template/header.php', $data);
            $this->load->view('mobile/account_view/registration_view');
        }
    }
  }

  function verify($hash=NULL)
  {
    if ($this->Account_model->verifyEmailID($hash))
    {
      $this->session->set_flashdata('verify_msg','<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
      redirect('home');
    }
    else
    {
      $this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
      redirect('home');
    }
  }

  public function login()
	{
    $data['title'] = 'Login';
    $data['display'] = 'display:none;';

		if ($this->input->server('REQUEST_METHOD') === 'POST')
		{
			$this->form_validation->set_rules('email', 'email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');


			if ($this->form_validation->run())
			{
        $userCaptcha = $this->input->post('userCaptcha');

        if($this->check_captcha($userCaptcha)){
          // captcha correct proceed to next validation
        }
        else{
          // reset captcha
          // numeric random number for captcha
          $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          // setting up captcha config
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
          $data['captcha'] = create_captcha($vals);
          $this->session->set_userdata('captchaWord',$data['captcha']['word']);

          $result['captcha'] = create_captcha($vals)['image'];
          $result['cap']=0;
          echo json_encode($result);
          return;
        }

				$username  = $this->input->post('email');
				$password  = $this->input->post('password');

				$_data = $this->Account_model->get_user($username);
        if($_data['isSuccess']==false){
          // reset captcha
          // numeric random number for captcha
          $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          // setting up captcha config
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
          $data['captcha'] = create_captcha($vals);
          $this->session->set_userdata('captchaWord',$data['captcha']['word']);

          $result['captcha'] = create_captcha($vals)['image'];
          $result['res']=0;
          echo json_encode($result);
          return;
        }

				$enc_pass	= explode(":", $_data["password"]);
				$salt		= $enc_pass[1];

				if(sha1($password.$salt)!=$enc_pass[0])
				{
          // reset captcha
          // numeric random number for captcha
          $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
          // setting up captcha config
          $vals = array(
                 'word' => $random_number,
                 'img_path' => './captcha/',
                 'img_url' => base_url().'captcha/',
                 'img_width' => 140,
                 'img_height' => 32,
                 'expiration' => 7200
                );
          $data['captcha'] = create_captcha($vals);
          $this->session->set_userdata('captchaWord',$data['captcha']['word']);

          $result['captcha'] = create_captcha($vals)['image'];
          $result['res']=0;
          echo json_encode($result);
					return;
				}
      //validation for banned user
      if($_data['user_type']==2){
        // reset captcha
        // numeric random number for captcha
        $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
        // setting up captcha config
        $vals = array(
          'word' => $random_number,
          'img_path' => './captcha/',
          'img_url' => base_url().'captcha/',
          'img_width' => 140,
          'img_height' => 32,
          'expiration' => 7200
        );
        $data['captcha'] = create_captcha($vals);
        $this->session->set_userdata('captchaWord',$data['captcha']['word']);

        $result['captcha'] = create_captcha($vals)['image'];

        $result['res']=3;
        echo json_encode($result);
        return;
	  	}

        $data = array(
						'username' 	=> $_data['username'],
						'id'  => $_data['id'],
						'is_logged_in' 	=> true,
						'user_type' => $_data['user_type']
				);

				$this->Account_model->set_active($username);
				$this->session->set_userdata($data);
        $result['done']=1;
        echo json_encode($result);
        return ;
			}
		}
    else if($this->session->userdata('is_logged_in')){
      redirect('home');
    }
		else{
      // numeric random number for captcha
      $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
      // setting up captcha config
      $vals = array(
        'word' => $random_number,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'img_width' => 140,
        'img_height' => 32,
        'expiration' => 7200
      );

      $data['captcha'] = create_captcha($vals);
      $this->session->set_userdata('captchaWord',$data['captcha']['word']);

      if($this->agent->is_mobile()){
        $this->load->view('mobile/template/header.php', $data);
        $this->load->view('mobile/login');
      }
      else{
        $this->load->view('template/header.php', $data);
        $this->load->view('login');
      }

		}
	}

  public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
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

  // generate random password_token
  private function gen_pass_token($email) {
    $length = 15;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $passToken = '';
    for ($i = 0; $i < $length; $i++) {
        $passToken .= $characters[rand(0, $charactersLength - 1)];
    }
    $salt = uniqid(mt_rand(), true);
    $passToken = $passToken.$salt;

    $this->Account_model->encrypt_pass_token($email, $passToken);

    return $passToken;
  }

  // send email to user
  private function sendEmail($to_email, $subject, $message){
    $this->load->helper('email');

		$from_email = 'utmbazaar@gmail.com';

    $this->load->library('email');

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'utmbazaar1'; //$from_email password
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

	function show_user() {
		$data['title'] = 'Edit User';
		$data['display'] = 'display:none;';

	if($this->session->userdata('is_logged_in'))
    {
      $data['username'] = $this->session->userdata('username');
  		$data['single_user'] = $this->Account_model->show_user($this->session->userdata('id'));
  		if($this->agent->is_mobile()){
        $this->load->view('mobile/template/header.php', $data);
      }
      else{
        $this->load->view('template/header.php', $data);
      }
  		$this->load->view('update_view', $data);
   }

    else{
      $this->login();
    }
	}


	function update_user() {

       // $update_s = $this->session->userdata($username);

    if($this->session->userdata('is_logged_in'))
    {
       $this->form_validation->set_rules('sirname', 'First Name', 'trim|required|min_length[3]|max_length[30]|xss_clean');
       $this->form_validation->set_rules('name', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
       $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email');

        if ($this->form_validation->run())
        {


    			$data = array(
    				'surname' => $this->input->post('sirname'),
    				'name' => $this->input->post('name'),
    				'email' => $this->input->post('email'),
    	    	);

    			$this->Account_model->update_user($this->session->userdata('id'),$data);


            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">You are Successfully Updated!</div>');

          redirect('account/show_user');
          }

          else
          {
            $data['titile'] = 'Edit User';
            $data['display'] = 'displayname';

            $data['single_user'] = $this->Account_model->show_user($this->session->userdata('id'));

            $this->load->view('template/header.php', $data);
            $this->load->view('update_view', $data);

          }

          }

    else{
      $this->login();
    }
  }

  public function check_captcha($str){
    $word = $this->session->userdata('captchaWord');
    if(strcmp(strtoupper($str),strtoupper($word)) == 0){
      return true;
    }
    else{
      return false;
    }
  }
}
