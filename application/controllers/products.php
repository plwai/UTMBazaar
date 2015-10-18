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

        }

        $query=$this->Product_model->get_products($owner_id);
        $_data['query'] = $query->result();
        $data['title'] = 'showproducts';
        $data['display'] = '';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_view', $_data);
    }
}


