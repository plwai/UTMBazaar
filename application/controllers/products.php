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
                    $description = strip_tags($this->input->post('product_description'));
                    $products_n = array(
                        'product_name' => $this->input->post('product_name'),
                        'price' => $this->input->post('product_price'),
                        'quantity' => $this->input->post('product_quantity'),
                        'category_id' => $this->input->post('product_category'),
                        'main_product_image'=> base_url().$img_fullpath.$filename,
                        'description' =>$description ,
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

    public function view_products($owner_id=null){
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;

        }

        $query=$this->Product_model->get_products($owner_id);
        $_data['query'] = $query->result();
        $data['title'] = 'showproducts';
        $data['display'] = '';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_view', $_data);
    }

    public function load_details($product_id){
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;
        }
        $query=$this->Product_model->get_products($product_id);
        $_data['query'] = $query->result();
        $data['title'] = 'loaddetails';
        $data['display'] = '';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_details_view', $_data);
    }

    public function add_cart(){

        $product_id = $this->input->post('product_id');
        $query = $this->Product_model->get_products($product_id);
        $query = $query->row_array();
        $data = array(
                'name'    => $query['product_name'],
                'id'=>$query['pk_id'],
                'max_qty'=>$query['quantity'],
                'price'   => $query['price'],
                'qty'=>1
                );
        $this->cart->insert($data);
        $result['res']=1;
        echo json_encode($result);
        return ;
    }

    public function view_cart(){
        if($this->session->userdata('is_logged_in')){
            $username = $this->session->userdata('username');
            $data['username']   = $username;

        }
        $data['title'] = 'loaddetails';
        $data['display'] = '';

        $this->load->view('template/header.php', $data);
        $this->load->view('cart_view');
    }
    public function update_cart(){
        $allpro=$this->cart->contents();
        $i = 1;
        if(!empty($allpro)){
            foreach($allpro as $allprovl){
                foreach($allpro as $allprovll){
                    if($this->input->post($i.'[rowid]')==$allprovll['rowid']){
                        $data = array(
                          'rowid' => $allprovll['rowid'],
                          'qty'   => $this->input->post($i.'[qty]')
                        );
                        $this->cart->update($data);
                    }
                    $i++;
                }
                $i=1;
            }
            redirect('/products/view_cart/', 'refresh');
        }
        else{
            $this->cart->destroy();
            redirect('/products/view_cart/', 'refresh');
        }
    }

  function delete()
	{
    $id  = $this->input->post('product_id');
		$this->cart->update(array('rowid' => $id, 'qty' => 0));
    $result['state']='success';

    echo json_encode($result);
    return;
	}

    public function confirm_order(){
        if($this->session->userdata('is_logged_in')){
            if($this->cart->contents()){
                foreach ($this->cart->contents() as $items){
                    $query = $this->Product_model->get_products($items['id']);
                    $query = $query->row_array();
                    if($items['qty']>$query['quantity']){
                        $result['problem_id']= $items['id'];
                        $result['problem_quantity']=$query['quantity'];
                        $result['state']=0;
                    }else{
                        $_data=array(
                            'quantity'=>($query['quantity']-$items['qty']));
                        $this->Product_model->update_product($items['id'],$_data);

                        $orderData = array(
                            'user_id' => $this->session->userdata('id'),
                            'product_id' => $items['id'],
                            'order_quantity' => $items['qty']
                        );

                        $this->Product_model->create_order($orderData);

                        $result['state']=1;
                    }
                }

            }
            else{
                $result['state']=2;
            }


        }else{
            $result['state']=3;
        }
        echo json_encode($result);
        return;
    }
    
    public function view_edit_cat() {
        $data['title'] = 'UTM Bazaar - Edit Category';
    $data['display'] = '';

    $username = $this->session->userdata('username');

    $data['username'] 	= $username;
    $data['category_data'] = $this->Product_model->load_category();

    // check whether user login
    if($this->session->userdata('is_logged_in')){
        $this->load->view('template/header', $data);
    }
    else{
        $this->load->view('template/header', $data);
    }
    
    $this->load->view('edit_categories_view');
    $this->load->view('template/footer');
    }
    
    public function add_category(){
        
        $ref = array('Category_name' => $this->input->post('cat_name'));
        $this->Product_model->add_cat($ref);
        
        redirect('products/view_edit_cat');
    }
    
    public function del_category($ref){
        
        $this->Product_model->del_cat($ref);
        
        redirect('products/view_edit_cat');
    }
    public function mineproduct(){
        if($this->session->userdata('is_logged_in')){
            $data['title'] = 'Mine Products';
            $data['display'] = '';
                        $username = $this->session->userdata('username');
            $data['username']   = $username;

            $query = $this->Product_model->get_products_by_owner($this->session->userdata('id'));
            $_data['query'] = $query->result();
            $this->load->view('template/header.php', $data);
            $this->load->view('myProduct_view',$_data);
        }else{
            redirect('account');
        }
    }
    public function change_product_state(){
        if($this->input->server('REQUEST_METHOD') === 'POST'){
            $product_id  = $this->input->post('product_id');
            $state = $this->input->post('state');
            if($state==1){
                $state=0;
            }else{
                $state=1;
            }
            $_data = array(
                'state'=>$state);
            $this->Product_model->update_product($product_id,$_data);
            $result['res']=1;

        echo json_encode($result);
        return;
        }
    }
}

