<?php

class product_model extends CI_Model {
    public function load_category(){
        $this->db->select('*');
        $this->db->from('utm_product_category');
        $category_data = $this->db->get();
        return $category_data->result();
    }

    public function inser_product($products) {
        $this->db->insert('utm_product', $products);
        return true;
    }

    public function get_product_id(){
        $higher = 0;
        $this->db->select('*');
        $query = $this->db->get('utm_product');
        foreach ($query->result() as $row){
            if($row->pk_id > $higher){
                $higher = $row->pk_id;
            }
        }
        return ($higher+1);
    }

    public function get_products($product_id){
        if($product_id==null){
            $this->db->select('*');
            $this->db->from('utm_product');
            $this->db->where('remove_state', 0 );
            $this->db->where( 'publish_state',1);
            $query = $this->db->get();
        }
        else{
            $this->db->select("utm_product.*,utm_users.name,utm_product_category.category_name");
            $this->db->from('utm_product');
            $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
            $this->db->join('utm_product_category','utm_product_category.pk_id = utm_product.category_id');
            $where = "(utm_product.pk_id = $product_id)";
            $this->db->where($where);
            $this->db->where('remove_state', 0 );
            $this->db->where( 'publish_state',1);
            $query = $this->db->get();
        }
        return $query;
    }

    public function update_product($id,$_data){
        $this->db->where('pk_id',$id);
        $this->db->update('utm_product', $_data);
    }

    public function create_order($order){
        $this->db->insert('utm_order', $order);
    }

    public function add_cat($cat_name) {
        $item = $cat_name;
        $this->db->insert('utm_product_category' , $item);
    }

    public function del_cat($id) {
        $this->db->where('pk_id', $id);
        $this->db->delete('utm_product_category');

        $this->db->where('category_id', $id);
        $this->db->delete('utm_product');
    }
    public function get_products_by_owner($owner_id){
        $this->db->select("utm_product.*,utm_users.name,utm_product_category.category_name");
        $this->db->from('utm_product');
        $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
        $this->db->join('utm_product_category','utm_product_category.pk_id = utm_product.category_id');
        $where = "(utm_product.user_id = $owner_id)";
        $this->db->where($where);
        $this->db->where('remove_state', 0 );
            $this->db->where( 'publish_state',1);
        $query = $this->db->get();
        
        return $query;
    }
    public function get_products_by_owner_ignore_publish($owner_id){
        $this->db->select("utm_product.*,utm_users.name,utm_product_category.category_name");
        $this->db->from('utm_product');
        $this->db->join('utm_users', 'utm_users.pk_id = utm_product.user_id');
        $this->db->join('utm_product_category','utm_product_category.pk_id = utm_product.category_id');
        $where = "(utm_product.user_id = $owner_id)";
        $this->db->where($where);
        $this->db->where('remove_state', 0 );

        $query = $this->db->get();
        
        return $query;
    }
    public function remove_product($product_id){
        $this->db->where('pk_id', $product_id);
        $data = array('remove_state' => 1);
        $this->db->update('utm_product', $data);

    }
}

?>
