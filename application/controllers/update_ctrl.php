<?php
	class update_ctrl extends CI_Controller{
		function __construct(){
		parent::__construct();
	
		$this->load->model('update_model');
	}
	
	function show_user_id() {
		$id = $this->uri->segment(3);
		$data['utm_users'] = $this->update_model->show_user();
		$data['single_user'] = $this->update_model->show_user_id($pkid);
		$this->load->view('update_view', $data);
	}
	
function update_user_id1() {
			$id= $this->input->post('did');
			$data = array(
				'User Name' => $this->input->post('name'),
				'Email' => $this->input->post('email'),
				//'User_Mobile' => $this->input->post('dmobile'),
				//'User_Address' => $this->input->post('daddress')
				);
		
			$this->update_model->update_user_id1($pkid,$data);
			$this->show_user_id();
		}
	}
?>