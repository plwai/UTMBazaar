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
    $data['title'] = "payment";

    // Get OAuthToken
    $apiContext = $this->getAccessToken();

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $item1 = new Item();
    $item1->setName('Item1')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice(7.5);
    $item2 = new Item();
    $item2->setName('Item2')
        ->setCurrency('USD')
        ->setQuantity(5)
        ->setSku("321321") // Similar to `item_number` in Classic API
        ->setPrice(2);

    $itemList = new ItemList();
    $itemList->setItems(array($item1, $item2));

    $details = new Details();
    $details->setShipping(1.2)
        ->setTax(1.3)
        ->setSubtotal(17.50);

    $amount = new Amount();
    $amount->setCurrency("USD")
    ->setTotal(20)
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
      $this->session->set_flashdata('msg', 'Something wrong now. Please try again later');

      $data['link'] = '';

      $this->load->view('template/header');
      $this->load->view('payment_view/payment', $data);
      return;
    }
    $approvalUrl = $payment->getApprovalLink();

    $data['link'] = $approvalUrl;

    $this->load->view('template/header', $data);
    $this->load->view('payment_view/payment', $data);
  }

  // Execute verified payment
  public function execute_payment(){
    $data['title'] = "payment";

    if($this->input->server('REQUEST_METHOD') === 'GET'){
      $success = $this->input->get('success', TRUE);

      if($success == 'false'){
        $this->session->set_flashdata('msg', 'Payment is not successful.');
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
