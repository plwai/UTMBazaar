<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class star extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->library( 'jquery_stars' );
	}
	
	public function add_rating() {
		
		$config = array('id'=>'mystar',
						'label'=>'rating',
						'disabled'=>FALSE,
						'enable_caption'=>TRUE,
						'one_vote'=>TRUE,
						'stars'=>array(
								array('value'=>'1','text'=>'Very poor'),
								array('value'=>'2','text'=>'Not that bad'),
								array('value'=>'3','text'=>'Average','selected'=>TRUE),
								array('value'=>'4','text'=>'Good'),
								array('value'=>'5','text'=>'Perfect')
								)
						);						
		$this->jquery_stars->set_place_holder_id('stars-wrapper');
		$this->jquery_stars->init_stars($config); 
		$data['star'] = $this->jquery_stars->get_stars();
		$this->load->view('/star/add_rating',$data); //just use " echo $star; " and your done!
	}
	
}
