<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Home controller to handle data in home page
    class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Product_model');
    }

    // Account controller index
    public function index(){
    $data['title'] = 'UTM Bazaar';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    $owner_id = NULL;

    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Product_model->get_products($owner_id);
    $data['product_list'] = $data['product_list']->result();

    // check whether user login
    if($this->session->userdata('is_logged_in')){
        if (!$this->agent->is_mobile()) {
            $this->load->view('template/header', $data);
            $this->load->view('home', $data); //$data
        }else{
            $this->load->view('mobile/template/header', $data);
            $this->load->view('mobile/home_view/home', $data); //$data
        }
    }
    else{
        if (!$this->agent->is_mobile()) {
            $this->load->view('template/header', $data);
            $this->load->view('home', $data); //$data
        }else{
            $this->load->view('mobile/template/header', $data);
            $this->load->view('mobile/home_view/home', $data); //$data
        }
    }
    if (!$this->agent->is_mobile()) {
        $this->load->view('template/footer');
    }else{
        $this->load->view('mobile/template/footer');
    }
  }
}
