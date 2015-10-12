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
			$this->test();
		}
		else{
      redirect('home');
		}
  }

  private function getAccessToken(){
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    // Replace these values by entering your own ClientId and Secret by visiting https://developer.paypal.com/webapps/developer/applications/myapps
    $clientId = 'Ac4yCwPGXeC8slrIQvGabV0ltNUe1pSoKg1_VZnRLsbqMw_548JJFakVJ6DX2PG3p492u6HyE6rPd3Dv';
    $clientSecret = 'EKiwU-KlkUvXHTXeJABAEKyX5nEyTYw6Kf4KzEVoFlnpJ-Mgdh5Zf0zXYdagKQlwBAyNUmacVNOa-PAd';

    /** @var \Paypal\Rest\ApiContext $apiContext */
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

    // #### SDK configuration
    // Register the sdk_config.ini file in current directory
    // as the configuration source.
    /*
    if(!defined("PP_CONFIG_PATH")) {
        define("PP_CONFIG_PATH", __DIR__);
    }
    */


    // ### Api context
    // Use an ApiContext object to authenticate
    // API calls. The clientId and clientSecret for the
    // OAuthTokenCredential class can be retrieved from
    // developer.paypal.com

    $apiContext = new ApiContext(
        new OAuthTokenCredential(
            $clientId,
            $clientSecret
        )
    );

    // Comment this line out and uncomment the PP_CONFIG_PATH
    // 'define' block if you want to use static file
    // based configuration

    $apiContext->setConfig(
        array(
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG', // PLEASE USE `FINE` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
            'cache.enabled' => true,
            // 'http.CURLOPT_CONNECTTIMEOUT' => 30
            // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
        )
    );

    // Partner Attribution Id
    // Use this header if you are a PayPal partner. Specify a unique BN Code to receive revenue attribution.
    // To learn more or to request a BN Code, contact your Partner Manager or visit the PayPal Partner Portal
    // $apiContext->addRequestHeader('PayPal-Partner-Attribution-Id', '123123123');

    return $apiContext;
  }

  public function test(){
    $apiContext = $this->getAccessToken();

    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $item1 = new Item();
    $item1->setName('Ground Coffee 40 oz')
        ->setCurrency('USD')
        ->setQuantity(1)
        ->setSku("123123") // Similar to `item_number` in Classic API
        ->setPrice(7.5);
    $item2 = new Item();
    $item2->setName('Granola bars')
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
    $redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
    ->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");

    $payment = new Payment();
    $payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

    $request = clone $payment;
    $payment->create($apiContext);
    $approvalUrl = $payment->getApprovalLink();

    $data['link'] = $approvalUrl;

    $this->load->view('test', $data);
  }
}
