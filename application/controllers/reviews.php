<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller{
    public function __construct(){
	   parent::__construct();
       $this->load->model('Reviews_model');
    }

    public function index(){
    }

    public function add_reviews(){
        if($this->session->userdata('is_logged_in')){
            $_data['error'] = "";
            $data['title'] = 'Reviews';
            $data['display'] = 'display:none;';
            $this->load->view('template/header.php', $data);
            $this->load->view('add_reviews_view',$_data);
        }
        else{
          redirect('account');
        }

    }

    public function save_reviews(){
        $this->form_validation->set_rules('cust_review','Review', 'trim|required|min_length[1]');
		if($this->input->server('REQUEST_METHOD') === 'POST')
		{
            if($this->form_validation->run()){
			$now = time();
            $date = date ("Y-m-d", $now);
            $time = date ("G:i:s", $now);

                    $date = $date.":".$time;
                    $new_reviews = array(
                        'cust_review' => $this->input->post('cust_review'),
						'product_id' => $this->input->post('product_id'),
						'user_id' => 2,
                        //'rating' => $this->input->post('cust_rating'),
                        'date_added'=>$date,
                    );

            $result = $this->Reviews_model->insert_review($new_reviews);
			
			$email = $this->Reviews_model->get_products($this->input->post('product_id'));
			$email = $email->row_array();
			$email => $email['email'];
			
			$subject = 'Your product had been reviewed!';
			$message = 'Dear Owner,<br /><br />Your product below had been reviewed. Click on the link below to read the review.<br /><br /> http://localhost/UTMBazaar/index.php/reviews/display_reviews/' . md5($email) . '<br /><br /><br />Thanks<br />UTMBazaar Team';
			$this->sendEmail($email,$subject,$message);

            redirect('home');
        }
		else{
             $_data['error'] = "";
            $data['title'] = 'Reviews';
            $data['display'] = 'display:none;';
            $this->load->view('template/header.php', $data);
			$this->load->view('add_reviews_view');
			}
		}
		else
		{
            echo "<script>window.location.href='" . base_url() . "reviews/add_reviews';
            alert('Error Occur');
            </script>";
        }

    }
	
	public function display_reviews($product_id=null)
	{
        $_data['query'] = $this->Reviews_model->view_reviews($product_id);
        $data['title'] = 'Product Reviews';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_reviews_view', $_data);
		
	}
	
	private function sendEmail($to_email, $subject, $message){
    $this->load->helper('email');

		$from_email = 'utmbazaar@gmail.com';

    $this->load->library('email');

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'utmbazaar1'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes


    $this->email->initialize($config);
		$this->email->set_newline("\r\n");

		//send mail
		$this->email->from($from_email, 'UTMBazaar');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
	}
}

?>