<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShoppingCart extends CI_Controller {

	public function buy($id)
	{
		$this->load->model ( 'mproduct' );
		$product = $this->mproduct->find($id);

		$data = array(
        'id'      => $product->id,
        'qty'     => 1,
        'price'   => $product->price,
        'name'    => $product->name
		);

		$this->cart->insert($data);
		$this->load->view('cart');
	}

	/*function remove($rowid) {
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($data);
		}
		
                 // This will show cancle data in cart.
		redirect('shopping');
	}*/
	
	function delete($rowid)
	{
		$this->cart->update(array('rowid' => $rowid, 'qty' => 0));
		$this->load->view('cart');
	}

	function update()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items)
		{

			$this->cart->update(array('rowid' => $items['rowid'], 'qty' => $_POST['qty'.$i]));
			$i++;
		}

		$this->load->view('cart');

	}
}