<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

// Payment controller to handle payment logic
class Pay_item extends CI_Controller{

  public function __construct(){
	  parent::__construct();

    $this->load->model('Pay_item_model');
  }

  // Account controller index
  public function index(){
    $data['title'] = 'UTM Bazaar';
    $data['display'] = '';

    $username = $this->session->userdata('username');

    $data['username'] 	= $username;

     // check whether user login
    if($this->session->userdata('is_logged_in')){
			$this->pay_online();
		}
		else{
      redirect('home');
		}
  }

  private function getAccessToken(){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $clientId = 'Ac4yCwPGXeC8slrIQvGabV0ltNUe1pSoKg1_VZnRLsbqMw_548JJFakVJ6DX2PG3p492u6HyE6rPd3Dv';
    $clientSecret = 'EKiwU-KlkUvXHTXeJABAEKyX5nEyTYw6Kf4KzEVoFlnpJ-Mgdh5Zf0zXYdagKQlwBAyNUmacVNOa-PAd';

    $apiContext = $this->getApiContext($clientId, $clientSecret);

    return $apiContext;
  }

  /**
   * Helper method for getting an APIContext for all calls
   * @param string $clientId Client ID
   * @param string $clientSecret Client Secret
   * @return PayPal\Rest\ApiContext
   */
  private function getApiContext($clientId, $clientSecret)
  {
    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true
        )
    );

    return $apiContext;
  }

  // link to paypal server
  public function pay_online(){
    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $data['title'] = "payment";

      // Get OAuthToken
      $apiContext = $this->getAccessToken();

      $payer = new Payer();
      $payer->setPaymentMethod("paypal");

      $orderID = $this->input->post('order_id[]');

      if($orderID == null){
        return;
      }

      $itemArray = array();
      $subTotalPrice = 0;
      $tax = 1;
      $shipping = 1;

      foreach($orderID as $key){
        // Verify order_id to make sure order data correct
        if(!$this->Pay_item_model->verifyOrder($key, $this->session->userdata('id'))){
          $this->session->set_flashdata('msg', 'Order data is not correct. Please try again later');

          $data['link'] = '';

          $this->load->view('template/header');
          $this->load->view('payment_view/payment', $data);

          return;
        }

        // Get item data
        $itemData = $this->Pay_item_model->getItem($key);
        $itemPrice = $itemData['price'] * $itemData['quantity'];

        $item1 = new Item();
        $item1->setName($itemData['name'])
            ->setCurrency('MYR')
            ->setQuantity($itemData['quantity'])
            ->setSku($itemData['id'])
            ->setPrice($itemData['price']);

        $subTotalPrice += $itemPrice;

        array_push($itemArray, $item1);
      }


      $itemList = new ItemList();
      $itemList->setItems($itemArray);

      $details = new Details();
      $details->setShipping($shipping)
          ->setTax($tax)
          ->setSubtotal($subTotalPrice);

      $amount = new Amount();
      $amount->setCurrency("MYR")
      ->setTotal($subTotalPrice + $shipping + $tax)
      ->setDetails($details);

      $transaction = new Transaction();
      $transaction->setAmount($amount)
      ->setItemList($itemList)
      ->setDescription("Payment description")
      ->setInvoiceNumber(uniqid());

      $baseUrl = base_url();
      $redirectUrls = new RedirectUrls();
      $redirectUrls->setReturnUrl($baseUrl."pay_item/execute_payment?success=true")
      ->setCancelUrl($baseUrl."pay_item/execute_payment?success=false");

      $payment = new Payment();
      $payment->setIntent("sale")
      ->setPayer($payer)
      ->setRedirectUrls($redirectUrls)
      ->setTransactions(array($transaction));

      $request = clone $payment;

      try{
        $payment->create($apiContext);
      }catch(Exception $ex){
        $this->session->set_flashdata('msg', 'Something wrong now. Please try again later'.$subTotalPrice);

        $data['link'] = '';

        $this->load->view('template/header', $data);
        $this->load->view('payment_view/payment', $data);
        return;
      }
      $approvalUrl = $payment->getApprovalLink();

      $data['link'] = $approvalUrl;

      $this->load->view('template/header', $data);
      $this->load->view('payment_view/payment', $data);

      header( "refresh:2;url=".$approvalUrl);
    }
    else{
      redirect('home');
    }
  }

  // testcase
  public function test(){
    $this->load->view('template/header');
    $this->load->view('payment_view/order_list');
  }

  // Execute verified payment
  public function execute_payment(){
    $data['title'] = "payment";

    if($this->input->server('REQUEST_METHOD') === 'GET'){
      $success = $this->input->get('success', TRUE);

      if($success == 'false'){
        $data['result'] = "payment canceled";
        $this->load->view('template/header', $data);
        $this->load->view('payment_view/payment_result');

        return;
      }

      // Get OAuthToken
      $apiContext = $this->getAccessToken();

      $paymentId = $this->input->get('paymentId', TRUE);
      $payment = Payment::get($paymentId, $apiContext);

      $execution = new PaymentExecution();
      $execution->setPayerId($this->input->get('PayerID', TRUE));

      try{
        $result = $payment->execute($execution, $apiContext);
        $data['result'] = $result;
      } catch(Exception $ex){
        $data['result'] = "Something wrong please try again.";
      }

      $this->load->view('template/header', $data);
      $this->load->view('payment_view/payment_result', $data);
    }
  }
}
