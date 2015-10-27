<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin controller handle admin function.
class Admin extends CI_Controller{
    public function __construct(){
       parent::__construct();
        $this->load->model('Ban_user_model');
    }

    public function index(){
    }

    public function view_user($user_id=null){
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;
        }

        $query=$this->Ban_user_model->get_user_list($user_id);
        $_data['query'] = $query->result();
		$dropdown['type_list'] = $this->Ban_user_model->get_dropdown();
        $data['title'] = 'admin_panel';
        $data['display'] = '';
        //$this->load->view('template/header.php', $data);
        $this->load->view('user_list', $_data, $dropdown);
    }
}

