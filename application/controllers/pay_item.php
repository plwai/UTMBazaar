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

    $data['display'] = '';

    $username = $this->session->userdata('username');

    $data['username'] 	= $username;

     // check whether user login

    if(!$this->session->userdata('is_logged_in')){
			redirect('account/login');
		}
  }

  // Account controller index
  public function index(){
    $this->pay_online();
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

  // extract response JSON data and insert into database
  private function extractData($response){
    $result['success'] = true;
    $response->toJSON();
    $response = json_decode($response);

    $createTime = $response->create_time;
    $payDate = $response->update_time;
    $payer = $response->payer;
    $transactions = $response->transactions;
    $transactionID = $transactions[0]->related_resources[0]->sale->id;
    $state = $transactions[0]->related_resources[0]->sale->state;
    $paymentState = $response->state;

    if($paymentState != 'approved'){
      $remark = "payment is not approved.";
      $result['success'] = false;
    }
    else if($state == 'completed'){
      $remark = "payment is successful.";
    }
    else{
      $remark = "payment is approved but not complete.";
      $result['success'] = false;
    }

    $paymentData = array(
                'transaction_id' => $transactionID,
                'payer_id'       => $payer->payer_info->payer_id,
                'create_time'    => $createTime,
                'date_paid'      => $payDate,
                'state'          => $state,
                'pay_type'       => $payer->payment_method,
                'remark'         => $remark
    );

    $paymentID = $this->Pay_item_model->setPayment($paymentData);

    if($state == 'completed' && $paymentState == 'approved'){
      $itemList = $transactions[0]->item_list->items;

      foreach($itemList as $item){
        $itemData = array(
          'payment_id'   => $paymentID,
          'order_status' => 1
        );

        $this->Pay_item_model->updateOrder($item->sku, $itemData);
      }
    }

    $result['paymentID'] = $paymentID;

    return $result;
  }

  // link to paypal server
  public function pay_online(){
    if($this->input->server('REQUEST_METHOD') === 'POST'){
      $data['title'] = "payment";
      $username = $this->session->userdata('username');
      $data['username'] 	= $username;

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
      ->setDescription("UTMBazaar online payment")
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

      header( "refresh:1;url=".$approvalUrl);
    }
    else{
      redirect('home');
    }
  }

  // Execute verified payment
  public function execute_payment(){
    $data['title'] = "payment";
    $username = $this->session->userdata('username');
    $data['username'] 	= $username;

    if($this->input->server('REQUEST_METHOD') === 'GET'){
      $success = $this->input->get('success', TRUE);

      if($success == 'false'){
        $data['result'] = "payment canceled";
        $this->load->view('template/header', $data);
        $this->load->view('payment_view/payment_result');
        header( "refresh:1;url=".base_url());
        return;
      }

      // Get OAuthToken
      $apiContext = $this->getAccessToken();

      $paymentId = $this->input->get('paymentId', TRUE);

      try{
        $payment = Payment::get($paymentId, $apiContext);
      } catch(Exception $ex){
        $data['result'] = "Something wrong please try again.";

        if ($this->agent->is_mobile()){
          $this->load->view('mobile_view/template/header', $data);
          $this->load->view('mobile_view/payment_view/payment_result_mobile');
        }
        else{
          $this->load->view('template/header', $data);
          $this->load->view('payment_view/payment_result', $data);
        }

        return;
      }

      $execution = new PaymentExecution();
      $execution->setPayerId($this->input->get('PayerID', TRUE));

      try{
        $result = $payment->execute($execution, $apiContext);
        $decoded_result = $this->extractData($result);

        if($decoded_result['success']){
          $data['result'] = "Payment success";
          $query = $this->Pay_item_model->getSpecificPaymentItem($decoded_result['paymentID']);

          $row = $query->result_array();

          $data['items'] = array();

          foreach($row as $item){
            $temp_data = array(
              'name' => $item['product_name'],
              'quantity' => $item['order_quantity'],
              'id' => $item['pk_id'],
              'price' => $item['price'],
              'image' => $item['main_product_image']
            );

            array_push($data['items'], $temp_data);
          }
        }
        else{
          $data['result'] = "error";
        }
      } catch(Exception $ex){
        $data['result'] = "Something wrong please try again.";
      }

        $list = "";

        if(isset($data['items'])){
          foreach($data['items'] as $item){
            $list .= "<div class='row'>";
            $list .= "<div class='col-sm-offset-3 col-sm-3'>";
            $list .= "</div>";
            $list .= "<div class='col-sm-5'><br><br><br>";
            $list .= "<label>Product Name: </label>".$item['name']." <br>";
            $list .= "<label>item Quantity: </label>".$item['quantity']." <br>";
            $list .= "<label>Total Price: </label>RM".(number_format(($item['price'] * $item['quantity']), 2, '.', ''))." <br>";
            $list .= "</div>";
            $list .= "</div><br><br> If that is not you, please contact us immediately.";
          }
        }

      $content = $data['result'].$list;
      $subject = "Payment Receipt";

      $this->sendEmail($username,$subject ,$content);

      if ($this->agent->is_mobile()){
        $this->load->view('mobile_view/template/header', $data);
        $this->load->view('mobile_view/payment_view/payment_result_mobile');
      }
      else{
        $this->load->view('template/header', $data);
        $this->load->view('payment_view/payment_result', $data);
      }
    }
  }

  // Display item to let user choose for payment
  public function view_list(){
    $data['title'] = "Order list";
    $username = $this->session->userdata('username');
    $data['username'] 	= $username;

    $orderList = $this->Pay_item_model->getOrderList($this->session->userdata('id'), true);

    $data['orderList'] = $orderList;

    if ($this->agent->is_mobile()){
      $this->load->view('mobile_view/template/header', $data);
      $this->load->view('mobile_view/payment_view/order_list_mobile');
    }
    else{
      $this->load->view('template/header', $data);
      $this->load->view('payment_view/order_list', $data);
    }


  }

   // send email to user
  private function sendEmail($to_email, $subject, $message){
    $this->load->helper('email');

		$from_email = 'utmbazaar@gmail.com';

    $this->load->library('email');

		//configure email settings
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com'; //smtp host name
		$config['smtp_port'] = '465'; //smtp port number
		$config['smtp_user'] = $from_email;
		$config['smtp_pass'] = 'utmbazaar1'; //$from_email password
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes


    $this->email->initialize($config);
		$this->email->set_newline("\r\n");

		//send mail
		$this->email->from($from_email, 'UTMBazaar');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);

		return $this->email->send();
	}
}
