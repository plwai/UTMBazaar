<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

	public function index($index = 0)
	{
		$data['listProduct'] = $this->mproduct->findAll();
		$this->load->view('template/header.php', $data);
		$this->load->view('index', $data);
	}
}