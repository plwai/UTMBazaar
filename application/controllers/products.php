<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Account controller handle account function.
class Products extends CI_Controller{
    public function __construct(){
       parent::__construct();
        $this->load->model('Product_model');
    }

    public function index(){
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
}


