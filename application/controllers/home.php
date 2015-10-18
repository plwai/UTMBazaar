<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Home controller to handle data in home page
    class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Search_model');
    }

    // Account controller index
    public function index(){
    $data['title'] = 'UTM Bazaar';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    
    $data['view'] = 'ajax_search';
    $data['username'] 	= $username;
    $product['category_data'] = $this->Search_model->load_category();
    $product['product_list'] = $this->Search_model->get_products();
    
    // check whether user login
    if($this->session->userdata('is_logged_in')){
        // set home page display item according to user recent view
        $this->load->view('template/header', $data);
        $this->load->view('home', $product); //$data
    }
    else{
        $this->load->view('template/header', $data);
        $this->load->view('home', $product); //$data
    }
    
    $this->load->view('template/footer');
  }
  
  /*
   * function give_more_data() {
    if (isset($_POST['category_id'])) {
      $data['ajax_req'] = TRUE;
      $data['node_list'] = $this->search_model->search_by_cat($_POST['category_id']);
      $this->load->view('ajax_index',$data);
    }
   */
  
}
