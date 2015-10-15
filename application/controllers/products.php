<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Products extends CI_Controller{
    public function __construct(){
	   parent::__construct();
        $this->load->model('Product_model');
    }

    public function index(){
    }

    public function view_products($owner_id=null){
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;
            $_data['query'] = $this->Product_model->view_products($owner_id);
            $data['title'] = 'showproducts';
            $data['display'] = '';
            $this->load->view('template/header.php', $data);
            $this->load->view('views_products_view', $_data);
        }else{
            redirect('account');
        }
    }
}
