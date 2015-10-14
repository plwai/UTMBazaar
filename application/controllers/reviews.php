<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller{
    public function __construct(){
	   parent::__construct();
       $this->load->model('Reviews_model');
    }

    public function index(){
    }

    public function add_reviews(){
        $_data['error'] = "";
        $data['title'] = 'Reviews';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('add_reviews_view',$_data);
    }

    public function save_reviews(){
        if($this->input->server('REQUEST_METHOD') === 'POST')
		{
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
        }
		else
		{
            echo "<script>window.location.href='" . base_url() . "reviews/add_reviews';
            alert('Error Occur');
            </script>";
        }
		$result = $this->Reviews_model->insert_review($new_reviews);
		redirect('home');
    }
	
	public function display_reviews($product_id=null)
	{
        $_data['query'] = $this->Reviews_model->view_reviews($product_id);
        $data['title'] = 'Product Reviews';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_reviews_view', $_data);
		
	}
}

?>