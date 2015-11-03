<?php
class Pages extends CI_Controller {

	public function __construct() {
                parent::__construct();
                $this->load->model('pages_model');
                $this->load->helper('url_helper');
                $this->load->model('Reviews_model');
        }

        public function index() {
		$this->load->helper('url');
                $pageData['title'] = 'All Products';
                $pageData['products'] = $this->pages_model->get_products();
                $this->load->view('template/header.php', $pageData);
                $this->load->view('views_reviews_view', $pageData);
                //$this->load->view('footer', $pageData);
        }

  public function display_reviews($product_id=null)
	{
        $_data['query'] = $this->Reviews_model->view_reviews($product_id);
        $data['title'] = 'Product Reviews';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
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
                $pageData['title'] = 'Reviews';
                $pageData['review'] = $this->pages_model->get_all_reviews();
                $this->load->view('template/header.php', $pageData);
                $this->load->view('admin', $pageData);
                //$this->load->view('footer', $pageData);
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