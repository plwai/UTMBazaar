<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ban user controller handle ban user function.
class Ban_user extends CI_Controller{
    public function __construct(){
       parent::__construct();
        $this->load->model('Ban_user_model');
    }

    public function index(){
    }

    public function view_user($user_id=null){
        if($this->session->userdata('is_logged_in')){
		    //validation for admin login
			if($this->session->userdata('user_type')==0){
				$username = $this->session->userdata('username');
				$data['username']   = $username;
				$query=$this->Ban_user_model->view_user($user_id);
				$_data['query'] = $query->result();
				$data['title'] = 'ban_user';
				$data['display'] = 'display:none;';
				$this->load->view('template/header.php', $data);
				$this->load->view('user_list', $_data);
            }
			else
			{
			    //temporary redirect to home first
				redirect ('home');
			}
		}
		else{
		    redirect ('account');
		}
        
    }
	
	public function change_ban_user(){
		$id  = $this->input->post('user_id');
		$user_type  = $this->input->post('option_value');

		$data = array(
                        'user_type' => $user_type
                    );
		$this->Ban_user_model->update_user($id, $data);
		$result['state']='success';

		echo json_encode($result);
		return;
	}
}

?>