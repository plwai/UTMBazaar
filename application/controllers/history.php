<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// History controller to handle data in home page
class History extends CI_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->model('History_model');

    $data['display'] = '';

    $username = $this->session->userdata('username');

    $data['username'] 	= $username;

    // check whether user login

    if(!$this->session->userdata('is_logged_in')){
      redirect('account/login');
    }
  }

  // History controller index
  public function index(){
    $this->view_history("Seller");
  }

  public function view_history($type){
    if($type != "Seller" && $type != "Buyer"){
      redirect('home');
    }
    else{
      $data['title'] = 'History';
      $data['display'] = '';
      $data['type'] = $type;

      $username = $this->session->userdata('username');

      $data['username'] 	= $username;

      $id = $this->session->userdata('id');

      $data['history'] = $this->History_model->get_history($type, $id);

      $this->load->view('template/header', $data);
      $this->load->view('history', $data);
    }
  }
}
