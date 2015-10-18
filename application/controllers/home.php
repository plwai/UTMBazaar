<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Home controller to handle data in home page
    class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Search_model');
    }

    // Account controller index
    public function index(){
    $data['title'] = 'UTM Bazaar';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    $owner_id = NULL;
    
    $data['view'] = 'ajax_search';
    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Product_model->view_products($owner_id);
    
    // check whether user login
    if($this->session->userdata('is_logged_in')){
        // set home page display item according to user recent view
        $this->load->view('template/header', $data);
        $this->load->view('home', $data); //$data
    }
    else{
        $this->load->view('template/header', $data);
        $this->load->view('home', $data); //$data
    }
    
    $this->load->view('template/footer');
  }
  
    function view_search_results() {
        if (isset($_POST['query'])) {
            $data['ajax_req'] = TRUE;
            $data['product_list'] = $this->Search_model->search_by_query($_POST['query']);
            $this->load->view('ajax_search',$data);
        };
    }
}
