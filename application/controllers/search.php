<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Home controller to handle data in home page
    class Search extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Search_model');
    }

    // Account controller index
    public function index(){
    $data['title'] = 'UTM Bazaar - Search Results';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    $ref = $this->input->post('search-query');
    
    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Search_model->search_by__name($ref);
    
    // check whether user login
    if($this->session->userdata('is_logged_in')){
        // set home page display item according to user recent view
        $this->load->view('template/header', $data);
    }
    else{
        $this->load->view('template/header');
    }
    
    $this->load->view('search_view', $data);
    $this->load->view('template/footer');
  }
  
  public function by_category($category_id){
      $data['title'] = 'UTM Bazaar - Search Results';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    
    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Search_model->search_by_cat($category_id);
    
    // check whether user login
    if($this->session->userdata('is_logged_in')){
        // set home page display item according to user recent view
        $this->load->view('template/header', $data);
    }
    else{
        $this->load->view('template/header');
    }
    
    $this->load->view('search_view', $data);
    $this->load->view('template/footer');
  }
  
}
