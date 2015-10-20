<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    // Search controller to handle data results in search page
    class Search extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Search_model');
        $this->load->library("pagination");
    }

    // Account controller index
    public function index(){
    $data['title'] = 'UTM Bazaar - Search Results';
    $data['display'] = '';

    $username = $this->session->userdata('username');
    $ref = $this->input->post('search-query');
    
    $config = array();
    $config["base_url"] = base_url() . "search";
    $config["total_rows"] = $this->Search_model->num_row_by_search($ref);
    $config["per_page"] = 6;
    $config['display_pages'] = FALSE;
    $config['prev_link'] = '&lt; Previous';
    $config['next_link'] = 'Next &gt;';
    
    $this->pagination->initialize($config);
    
    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Search_model->search_by__name($config["per_page"], $ref);
    $data["links"] = $this->pagination->create_links();
    
    // check whether user login
    if($this->session->userdata('is_logged_in')){
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
    
    $config = array();
    $config["base_url"] = base_url() . "search";
    $config["total_rows"] = $this->Search_model->num_row_by_cat($category_id);
    $config["per_page"] = 6;
    $config['display_pages'] = FALSE;
    $config['prev_link'] = '&lt; Previous';
    $config['next_link'] = 'Next &gt;';
    
    $this->pagination->initialize($config);
    
    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();
    $data['product_list'] = $this->Search_model->search_by_cat($config["per_page"], $category_id);
    $data["links"] = $this->pagination->create_links();
    
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
