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
            $username = $this->session->userdata('username');
            $data['username']   = $username;
        }

        $query=$this->Ban_user_model->view_user($user_id);
        $_data['query'] = $query->result();
		//$dropdown['type_list'] = $this->Ban_user_model->get_dropdown();
        $data['title'] = 'ban_user';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('user_list', $_data/*, $dropdown*/);
    }
	
	/*public update_ban_user(){
	    if($this->session->userdata('is_logged_in'))
		{
		    $i = 1;
			$data = this->input->post($type);
		    $this->Ban_user_model->update_user($this->session->userdata('id'),$data);
		}
		else
		{
		    redirect('account');
		}
	}
	
	public change_ban_user(){
		$id  = $this->input->post('user_id');
		$result['state']='success';

		echo json_encode($result);
		return;
	}*/
}

?>