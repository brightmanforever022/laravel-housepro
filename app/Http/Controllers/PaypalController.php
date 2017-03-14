<?php
namespace App\Http\Controllers;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Service\AdaptivePaymentsService;


use Config;
use URL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Redirect;
use App;
use DB;
use Response;
use App\Vechile;
use App\BillingInfo;
use App\Property;
use App\Message;
use PayPal\Api\Sale;
use PayPal\Api\Refund;
use App\Payment as PaymentUser;
use App\Transaction as HostTransaction;
use App\User;

class PaypalController extends Controller
{
private $_api_context;

    public function __construct(Property $property, BillingInfo $billingInfo, PaymentUser $payment_user, HostTransaction $transaction, User $user, Message $message)
    {
        $this->property = $property;
        // setup PayPal api context
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->billingInfo = $billingInfo;
        $this->payment_user = $payment_user;
        $this->transaction = $transaction;
        $this->helper = new \ApartHelper;
        $this->user   = $user;
        $this->message = $message;
        //$this->middleware('advertiser');
    }
	public function postPayment(Request $request)
	{
		//dd($request->all());
		Session::put('allValues2',json_encode($request->all()));

		if (array_key_exists("user_id",$request->all()))
		{
		  echo "Key exists!";
		}
		else
		{
		  echo "Key does not exist!";
		}
	    	
	    $payer = new Payer();
	    $payer->setPaymentMethod('paypal');

	    $item = new Item();
	    $item->setName($request['item_id']) // item name
	        ->setCurrency('CHF')
	        ->setQuantity(1)
	        ->setPrice($request['init_price']); // unit price


	    // add item to list
	    $item_list = new ItemList();
	    $item_list->setItems(array($item));

	    $amount = new Amount();
	    $amount->setCurrency('CHF')
	        ->setTotal($request['init_price']);

	    $transaction = new Transaction();
	    $transaction->setAmount($amount)
	        ->setItemList($item_list)
	        ->setDescription($request['user_id']);

	    $redirect_urls = new RedirectUrls();
	    $redirect_urls->setReturnUrl(URL::route('payment.status'))
	        ->setCancelUrl(URL::route('payment.status'));

	    $payment = new Payment();
	    $payment->setIntent('Sale')
	        ->setPayer($payer)
	        ->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));

	    try {
	        $payment->create($this->_api_context);
	    } catch (\Exception $ex) {
  			if (\Config::get('app.debug')) {
		    	echo "Exception: " . $ex->getMessage() . PHP_EOL;
		    	$err_data = json_decode($ex->getData(), true);
		    	exit;
			} else {
		    	die('Some error occur, sorry for inconvenient');
		  	}
		}

	    foreach($payment->getLinks() as $link) {
	        if($link->getRel() == 'approval_url') {
	            $redirect_url = $link->getHref();
	            break;
	        }
	    }

	    // add payment ID to session
	    Session::put('paypal_payment_id', $payment->getId());

	    if(isset($redirect_url)) {
	        // redirect to paypal
	        return Redirect::away($redirect_url);
	    }

	    //return Redirect::route('original.route')->with('error', 'Unknown error occurred');
	    return redirect('/')->with('error', 'Payment failed');
	}

	public function getPaymentStatus()
	{
		$payment_id =  (null === Session::get('paypal_payment_id')) ?: Input::get('paymentId');

	    // clear the session payment ID
	   // Session::forget('paypal_payment_id');

	    if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
	        return Redirect::route('original.route')
	            ->with('error', 'Payment failed');
	    }
		try {
	    $payment = Payment::get($payment_id, $this->_api_context);

	    // PaymentExecution object includes information necessary 
	    // to execute a PayPal account payment. 
	    // The payer_id is added to the request query parameters
	    // when the user is redirected from paypal back to your site
	    $execution = new PaymentExecution();
	    $execution->setPayerId(Input::get('PayerID'));
	    
	    //Execute the payment
	    $result = $payment->execute($execution, $this->_api_context);

	    } catch(\Exception $e) {
		  //exception handling
		  return redirect('/')->with('error', 'Payment failed');
		}
	    
        $billings = json_decode(Session::get('allValues2'));
	    if ($result->getState() == 'approved') { // payment made
		    $value = $result->toArray(); //dd($value['transactions']);
		    $id = $value['id'];
	        $item = $value['transactions'][0]['item_list']['items'][0]['name']; 
	        $price = $value['transactions'][0]['item_list']['items'][0]['price']; 
		    $user_id = Auth::user()->id;
		    $pay_result = App\Payment::create([
	        	'user_id' 		=> $user_id,
	        	'host_id'       => $billings->host_id,
	        	'billing_id' 	=> $item,
	        	'token'			=> $id,
	        	'status'		=> 'approved',
	        	'amount'		=> $billings->price,
	        	'initial'       => $price
	        ]);
            $this->property->where('id', $item)->update(['booking_id' => $pay_result->id, 'property_booking_status' => 0]);

            //$tenant_user = \App\User::where('id', $billings->host_id)->get();
            $property_host  = $this->property->where('id', $item)->get();

           
       
           $billing_result = BillingInfo::create(['check_in' => \DateTime::createFromFormat('d/m/y H:i', $billings->startdate_single." 00:00")->format('Y-m-d'), 'check_out' => \DateTime::createFromFormat('d/m/y H:i', $billings->end_date_single." 00:00")->format('Y-m-d'), 'guests' => $billings->bedroom, 'nights' => $billings->nights, 'saluation' => $billings->saluation, 'name' => $billings->name, 'surname' => $billings->surname, 'phone' => substr($billings->phone,3), 'email' => $billings->email, 'remark' => $billings->remark, 'booking_id' => $pay_result->id, 'booking_status_tenant' => 1]);


		    $data['property_id'] = $item;
		    $data['booking_id']  = $pay_result->id;
		    $data['owner_id']    = $user_id;
		    $data['message']     = $billings->remark;
		    $data['is_read']     = 0;
		    $this->message->create($data);

    
		    //$Vechile_id = $billing_result['vehicle_id'];

	        //Vechile::where('id', $Vechile_id)->update(['changes_status' => 2]);

            $mail_photo_path  = 'img/photo.png';
            if(Auth::check() && Auth::user()->path != "")
            $mail_photo_path  = 'profilepics/'.Auth::user()->path;	
            
            if(count($property_host[0]->images) == 0)
            	$image = '';
            else
            	$image = $property_host[0]->images[0]->path;
		    $admin_mail_data = [
		          'company'    => '',
		          'host_image' =>  $mail_photo_path,
		          'host_name'  =>  Auth::user()->name.' '.Auth::user()->surname,
		          'created_at' =>  Auth::user()->created_at,
		          'property_image' => 'images/thumb/'.$image,
		          'property_id'=> $property_host[0]->id,
		          'title'      => $property_host[0]->title,
		          'street'     => $property_host[0]->street,
		          'plz_place'  => $property_host[0]->plz_place,
		          'check_in'   => \DateTime::createFromFormat('d/m/y H:i', $billings->startdate_single." 00:00")->format('Y-m-d'),
		          'check_out'  => \DateTime::createFromFormat('d/m/y H:i', $billings->end_date_single." 00:00")->format('Y-m-d'),
		          'price'      => $billings->price,
		          'nights'     => $billings->nights,
		          'initial'    => $price,
		          'remark'	   => $billings->remark,
                  'name'       => $property_host[0]->user->name,
                  'email'      => $property_host[0]->user->email,
                  'view'       => 'emails.after-booking-host',
                  'subject'    => 'Booking Request',
                  'attach'     => url('/').'/bookings/',
              ];
      

      
		    try 
		    {
		        $admin_mail_data['link' ] = url('/') . '/single/';
				$this->helper->send_mail($admin_mail_data);
			}catch (\Exception $e)
		    {
		        dd($e);
		                          
		    }
            \Session::flash('message','Payment done booking sent for approval.');
	        return redirect('/booking-tenant');

	        //return Redirect::route('original.route')
	            //->with('success', 'Payment success');
	    }
	    return redirect('/')->with('error', 'Payment failed');
	}

	public function refundSale($transaction_id)
	{
		try {
		$payment = Payment::get($transaction_id, $this->_api_context);
		$token_trans = $this->payment_user->where('token', $transaction_id)->get()->toArray();
		$cancel_fee = $this->property->where('id', $token_trans[0]['billing_id'])->get()->toArray();
		$provider = $this->user->where('id', $cancel_fee[0]['user_id'])->get()->toArray();
		$transactions = $payment->getTransactions();
		$relatedResources = $transactions[0]->getRelatedResources();
		$sale = $relatedResources[0]->getSale();
		
        
		if($sale->state == 'partially_refunded' || $sale->state ==  'refunded')
		{
			//echo "Alredy Refunded";
			\Session::flash('message','Already payment refunded to tenant.');
            return redirect('/admin_payment');
		}else
		{
			$saleId = $sale->getId();
			$sale = Sale::get($saleId, $this->_api_context);
			$amt = new Amount();
			$percent_refund = $sale->amount->total - ($cancel_fee[0]['cancel_fee'] * $token_trans[0]['amount'] /100);

			if($percent_refund > 0)
			{
			 $amt->setCurrency('CHF')
			    ->setTotal($percent_refund);
			}else
			{
			  $amt->setCurrency('CHF')
			    ->setTotal(0);	
			}

			// ### Refund object
			$refund = new Refund();
			$refund->setAmount($amt);
			// ###Sale
			// A sale transaction.
			// Create a Sale object with the
			// given sale transaction id.
			//$sale = new Sale();
			//die;
			$sale->setId($saleId);
			try {
			    // Create a new apiContext object so we send a new
			    // PayPal-Request-Id (idempotency) header for this resource
			    $paypal_conf = Config::get('paypal');
			    $apiContext = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
			    // Refund the sale
			    // (See bootstrap.php for more on `ApiContext`)
			    //$refundedSale = $sale->refund($refund, $apiContext);
			    $result_provider = $this->payCancelFeeHost($provider[0]['paypal_email'], ($cancel_fee[0]['cancel_fee'] * $token_trans[0]['amount'] /100));
			    if($result_provider == "Success"){
				    $for_renewel = $this->payment_user->where('token', $transaction_id)->get();
	                $this->payment_user->where('token', $transaction_id)->update(['refund_status' => 1]);
	                $this->property->where('id', $for_renewel[0]->billing_id)->update(['property_booking_status' => 0, 'booking_id' => 0]);

			    \Session::flash('message','Payment refunded to tenant successfully.');
				}
       			return redirect('/admin_refunded'); 
			} catch (\Exception $ex) {
			    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			 	//ResultPrinter::printError("Refund Sale", "Sale", $refundedSale->getId(), $refund, $ex);
			 	//echo "<pre>"; print_r($ex); die;
			 	//echo "Failed"; die;
			 	Session::flash('message','Payment Failed.');
       			return redirect('/admin_payment');

			   
			}
	    }

	    } catch (\Exception $ex) {
			    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			 	//ResultPrinter::printError("Refund Sale", "Sale", $refundedSale->getId(), $refund, $ex);
			 	Session::flash('message','Payment Failed.');
       			return redirect('/admin_payment');

			   
			}

		
	}

    public function payCancelFeeHost($paypal_email, $amount)
	{
		
		$payRequest = new PayRequest();

		$receiver = array();
		$receiver[0] = new Receiver();
		$receiver[0]->amount = round($amount, 2);//"1.00";
		$receiver[0]->email = $paypal_email;//"platfo_1255170694_biz@gmail.com";
		$receiverList = new ReceiverList($receiver);
		$payRequest->receiverList = $receiverList; 			
		$payRequest->senderEmail = "aashisht09-facilitator-1@gmail.com";


		$requestEnvelope = new RequestEnvelope("en_US");
		$payRequest->requestEnvelope = $requestEnvelope; 
		$payRequest->actionType = "PAY";
		$payRequest->cancelUrl = "http://localhost:8000/";
		$payRequest->returnUrl = "http://localhost:8000/";
		$payRequest->currencyCode = "CHF";
		$payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";

		$sdkConfig = array(
			'mode' => 'sandbox',
            'acct1.AppId' => 'APP-80W284485P519543T',
            'acct1.UserName' => 'aashisht09-facilitator-1_api2.gmail.com',
            'acct1.Password' => 'UU47LTZRMRHPCV52',
            'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AFmryqlDJ5xoqJZiAAq2o3GdrP5z',
		);

                try {

		        $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
				$payResponse = $adaptivePaymentsService->Pay($payRequest);
				return "Success";
				              	
                } catch (\Exception $ex) {
                	
			    return "Failed";
			    }
				//print_r($payResponse);
				//die;


	}
     
	public function payToHost($paypal_email, $amount, $booking_id, $user_id)
	{
		
		$payRequest = new PayRequest();

		$receiver = array();
		$receiver[0] = new Receiver();
		$receiver[0]->amount = round($amount, 2);//"1.00";
		$receiver[0]->email = $paypal_email;//"platfo_1255170694_biz@gmail.com";
		$receiverList = new ReceiverList($receiver);
		$payRequest->receiverList = $receiverList; 			
		$payRequest->senderEmail = "aashisht09-facilitator-1@gmail.com";


		$requestEnvelope = new RequestEnvelope("en_US");
		$payRequest->requestEnvelope = $requestEnvelope; 
		$payRequest->actionType = "PAY";
		$payRequest->cancelUrl = "http://localhost:8000/";
		$payRequest->returnUrl = "http://localhost:8000/";
		$payRequest->currencyCode = "CHF";
		$payRequest->ipnNotificationUrl = "http://replaceIpnUrl.com";

		$sdkConfig = array(
			'mode' => 'sandbox',
            'acct1.AppId' => 'APP-80W284485P519543T',
            'acct1.UserName' => 'aashisht09-facilitator-1_api2.gmail.com',
            'acct1.Password' => 'UU47LTZRMRHPCV52',
            'acct1.Signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AFmryqlDJ5xoqJZiAAq2o3GdrP5z',
		);

                try {

		        $adaptivePaymentsService = new AdaptivePaymentsService($sdkConfig);
				$payResponse = $adaptivePaymentsService->Pay($payRequest);

				
               	$this->transaction->create(['payKey' => $payResponse->payKey, 'paytime' =>  $payResponse->responseEnvelope->timestamp, 'user_id' => $user_id,'status' => $payResponse->paymentInfoList->paymentInfo[0]->transactionStatus, 'transactionId' => $payResponse->paymentInfoList->paymentInfo[0]->transactionId, 'email'=> $payResponse->paymentInfoList->paymentInfo[0]->receiver->email,'amount'=> $payResponse->paymentInfoList->paymentInfo[0]->receiver->amount,'booking_id' => $booking_id]);
               	$this->payment_user->where('id', $booking_id)->update(['refund_status' => 2]);
               	// $this->property->where('booking_id', $booking_id)->update(['property_booking_status' => 0, 'booking_id' => 0]);
                \Session::flash('message','Payment transffred to host successfully.');
                return redirect('/admin_transferd');

                } catch (\Exception $ex) {
                	
			    // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
			 	\Session::flash('message','Payment Failed.Please Check host paypal id properly');
                return redirect('/admin_payment');
			    }
				//print_r($payResponse);
				//die;


	}
}