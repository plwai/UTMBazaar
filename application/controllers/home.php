<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Home controller to handle data in home page
class Home extends CI_Controller{

  public function __construct(){
	  parent::__construct();
  }

  // Account controller index
  public function index(){
    $data['title'] = 'UTM Bazaar';
    $data['display'] = '';

    $username = $this->session->userdata('username');

    $data['username'] 	= $username;

    // check whether user login
    if($this->session->userdata('is_logged_in')){
			// set home page display item according to user recent view
      $this->load->view('template/header.php', $data);
      $this->load->view('home');
		}
		else{
      $this->load->view('template/header.php', $data);
			$this->load->view('home');
		}
  }
}