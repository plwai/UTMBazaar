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
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;
            $_data['category_data'] = $this->Product_model->load_category();
            $_data['error'] = "";
            $data['title'] = 'Add Product';
            $data['display'] = '';
            $this->load->view('template/header.php', $data);
            $this->load->view('add_products_view',$_data);
        }else{
            redirect('account');
        }
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
                    $img_fullpath = "uploads/" .$this->Product_model->get_product_id()."/";
                    $now = time();
                    $date = date ("Y-m-d", $now);
                    $time = date ("G:i:s", $now);

                    $date = $date.":".$time;
                    $products_n = array(
                        'product_name' => $this->input->post('product_name'),
                        'price' => $this->input->post('product_price'),
                        'quantity' => $this->input->post('product_quantity'),
                        'category_id' => $this->input->post('product_category'),
                        'main_product_image'=> base_url().$img_fullpath.$filename,
                        'description' => $this->input->post('product_description'),
                        'user_id'=>$this->session->userdata('id'),
                        'date_added'=>$date,
                        'image' => $img_fullpath
                    );


                } else {
                    $username = $this->session->userdata('username');
                    $data['username']   = $username;
                    $_data['category_data'] = $this->Product_model->load_category();
                    $_data['error'] = "Error occur somewhere, please do again!!";
                    $data['title'] = 'Add Product';
                    $data['display'] = '';
                    $this->load->view('template/header.php', $data);
                    $this->load->view('add_products_view',$_data);
                }
                $position = $position+1;
                $upload_state=true;
                

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
            $username = $this->session->userdata('username');
            $data['username']   = $username;
            $_data['category_data'] = $this->Product_model->load_category();
            $_data['error'] = "Error occur somewhere, please do again!!";
            $data['title'] = 'Add Product';
            $data['display'] = '';
            $this->load->view('template/header.php', $data);
            $this->load->view('add_products_view',$_data);

        }
    }
}


