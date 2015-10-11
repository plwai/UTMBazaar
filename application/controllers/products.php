<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Products extends CI_Controller{
    public function __construct(){
	   parent::__construct();
        $this->load->model('Product_model');
    }

    public function index(){
    }

    public function add_products(){
        $_data['category_data'] = $this->Product_model->load_category();
        $_data['error'] = "";
        $data['title'] = 'Login';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('add_products_view',$_data);
    }

    public function save_product(){
        if($this->input->server('REQUEST_METHOD') === 'POST'){
            $img_fullpath = '';
            $upload_state= false;
            $position = 0;
            while (!empty($_FILES["up_file"]["tmp_name"][$position])){
                $filename = time() .$position. ".png";
                $target_dir = "uploads/".$this->Product_model->get_product_id()."/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_file = $target_dir . $filename;
    
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if (move_uploaded_file($_FILES["up_file"]["tmp_name"][$position], $target_file)){
                    $img_fullpath = base_url() . "uploads/" .$this->Product_model->get_product_id()."/";
                    $now = time();
                    $date = date ("Y-m-d", $now);
                    $time = date ("G:i:s", $now);

                    $date = $date.":".$time;
                    $products_n = array(
                        'product_name' => $this->input->post('product_name'),
                        'product_price' => $this->input->post('product_price'),
                        'product_quantity' => $this->input->post('product_quantity'),
                        'category_id' => $this->input->post('product_category'),
                        'product_description' => $this->input->post('product_description'),
//added session id to this after add session
                        'user_id'=>29,
                        'date_added'=>$date,
                        'product_image' => $img_fullpath
                    );


                } else {
                    echo "<script>window.location.href='" . base_url() . "products/add_products';
                    alert('Dear user please confirm your email address in your inbox.');
                    </script>";
                }
                $position = $position+1;
                $upload_state=true;
                echo "<script type='text/javascript'>alert('submitted successfully!')</script>";

            }
        }
        if($upload_state ==true){
            $_data['error'] = "";
            $data['title'] = 'Login';
            $data['display'] = 'display:none;';
            $result = $this->Product_model->inser_product($products_n);
            $this->view_products();
        }
        else{
            echo "<script>window.location.href='" . base_url() . "products/add_products';
            alert('Dear user please confirm your email address in your inbox.');
            </script>";

        }
    }

    public function view_products($owner_id=null){
        $_data['query'] = $this->Product_model->view_products($owner_id);
        $data['title'] = 'showproducts';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_view', $_data);
    }

    public function load_details($product_id){
        $_data['query'] = $this->Product_model->load_details($product_id);
        $data['title'] = 'loaddetails';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_details_view', $_data);
    }
}
