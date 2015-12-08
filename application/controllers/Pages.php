<?php
class Pages extends CI_Controller {

	public function __construct() {
                parent::__construct();
                $this->load->model('pages_model');
                $this->load->helper('url_helper');
                $this->load->model('Reviews_model');
                $this->load->library("pagination");
        }

   /*  public function example1() {
        $config = array();
        $config["base_url"] = base_url() . "welcome/example1";
        $config["total_rows"] = $this->Countries->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["results"] = $this->Countries->
            fetch_countries($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();

        $this->load->view("example1", $data);
    }*/


  public function index() {
        $config = array();
		$this->load->helper('url');
                $pageData['title'] = 'All Products';
                $pageData['products'] = $this->pages_model->get_products();
                $this->load->view('template/header.php', $pageData);
                $this->load->view('views_reviews_view', $pageData);
               
        }

  public function display_reviews($product_id=null)
	{
        $this->load->helper('url');
        $config = array();
        $config["base_url"] = base_url() . "pages/display_reviews";
        $config["total_rows"] = $this->pages_model->record_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);

        $_data['query'] = $this->Reviews_model->view_reviews($product_id);
        $pageData['title'] = 'Product Reviews';
        
        $this->load->view('template/header.php', $pageData);
        $this->load->view('review', $_data);
		
	}

	public function saveReview() {
		$productId =   $_POST['productId'];
		$review = $_POST['review'];
		$rating = $_POST['rating'];
		$userId = '1'; // replace this by user id after receiving when user is logged in
		$this->pages_model->add_reviews($productId, $review, $rating, $userId);
		$this->load->helper('url');
		$url = site_url().'pages/review/'.$productId;
		header('location:'.$url);exit(0);
	}

	public function admin() {
		$this->load->helper('url');
        $config = array();
        $config["base_url"] = base_url() . "pages/admin";
        $config["total_rows"] = $this->pages_model->record_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

                $pageData['title'] = 'Reviews';
                $pageData['review'] = $this->pages_model->get_all_reviews($config["per_page"], $page);
                $pageData['links'] = $this->pagination->create_links();
                $this->load->view('template/header.php', $pageData);
                $this->load->view('admin', $pageData);
                
	}

	public function deleteReview($slug = NULL) {
		$this->load->helper('url');
                $pageData['title'] = 'Reviews';
                if($slug == NULL) {
                        $url = site_url().'/pages/admin';
                        header('location:'.$url);exit(0);
                }
                $this->pages_model->delete_reviews($slug);
		$url = site_url().'/pages/admin';
                        header('location:'.$url);exit(0);
	}

}
?>