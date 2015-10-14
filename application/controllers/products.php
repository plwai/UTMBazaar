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
        $_data['query'] = $this->Product_model->load_details($product_id);
        $data['title'] = 'loaddetails';
        $data['display'] = 'display:none;';
        $this->load->view('template/header.php', $data);
        $this->load->view('views_products_details_view', $_data);
    }

    public function add_cart(){
        $product_id = $this->input->post('product_id');
        $query = $this->Product_model->view_productss($product_id);
        
       
            $data = array(

                'name'    => $query['product_name'],
                'id'=>$query['product_pk_id'],
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

        $data['title'] = 'loaddetails';
        $data['display'] = 'display:none;';

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
}


