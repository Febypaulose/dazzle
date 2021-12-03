<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\helpers;
use App\Helpers\Canadapost;
use App\Helpers\Fedex;
use SoapClient;
use CanadaPost\Rating;
use Redirect;
use Decrement;
use App\Classes\mpgGlobals;
use App\Classes\mpgTransaction;
use App\Classes\CofInfo;
use App\Classes\mpgRequest;
use App\Classes\mpgHttpsPost;

use App\model\Country;
use App\model\Carts;
use App\model\Orders;
use App\model\suborders;
use App\model\Invoice;
use App\model\Billingdetails;
use App\model\Shippingaddress;
use App\model\Accounts;
use App\model\Addresses;
use App\model\guestcart;
use App\model\Coupons;
use App\model\Usercoupons;
use App\model\Products;

use App\Mail\ordermail;
use App\Mail\invoicemail;




use Crypt;
use Session;









class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
      // asset(env('PEM_FILE').'/cacert.pem'); 
       //Storage::disk('pem')->get('cacert.pem');
       //canada Post
       // $canadashipper = Accounts::where('slug','=','canada-post')->first();
       // $canadashipperId = $canadashipper->shipperid;
       // $canadapost = new Canadapost();
       // $rate = $canadapost->calculaterates($canadashipperId); 
       // $shipper = $canadapost->createshipper(); 
       // $cashipper = json_decode($shipper);
       // $capostshipperid = $cashipper->data->id;
       // $capostslug = $cashipper->data->slug;
       // $credentials = $canadapost->addcredentials($capostshipperid,$capostslug);

        //$rates = $canadapost->getrates($pemfile);
       // $fedex = new Fedex();
       // //$shipper = $fedex->createshipper();
       // $rates = $fedex->calculaterates();
        $helpers = new helpers();
        
        if (Auth::user()) {
            $loggedinId = Auth::user()->id;
            $sessionId = Session::get('sessionid');
            if (!empty($sessionId)) {
                $cart = $helpers->addguestcart($sessionId); 
             } 
        } else {
           $loggedinId = Session::get('sessionid'); 
           Session::put('type', "buyer");
           Session::put('page', "checkout");
           return redirect('questlogin');
             
        }
        $data['country'] = Country::all();
        $data['user'] = Auth::user();
        $data['addresses'] = Addresses::where('userid','=',$loggedinId)->get();
       
        $data['carts'] = Carts::select('carts.productId','carts.quantity','products.product_price','products.product_name','carts.id')
                         ->join('products', 'carts.productId', '=', 'products.Id')
                         ->where('product_quantity' ,'>',0)
                         ->where('carts.UserId','=',$loggedinId)
                         ->get();
       
        return view('frontent/checkout',$data);
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
                'paymenttype'     => 'required',
                'fname'           => 'required',
                'lname'           => 'required',
                'mail'            => 'required',
                'phone'           => 'required',
                'address1'        => 'required',
                'address2'        => 'required',
                'city'            => 'required',
                'countryid'       => 'required',
                'pocode'          => 'required',
            ]);

            if ($validator -> fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $loggedinId = Auth::user()->id;
                $addrsave = $request->addr_save;
                $currency = env('BASE_CURR');
                $invoice = Invoice::latest()->first();

                $order = Orders::latest()->first();



                $year = date("Y"); 
                $month = date("m"); 
                //dd($_SERVER['REMOTE_ADDR']);

                $ip = '116.68.68.116';
                $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}")); 


              
                if (empty($invoice)) {
                    $invoiceno = 'INV'.'-'.'DAZLKN'.'-'.$year.'-'.$month.'-'.'0000001'; 
                } else {
                    $oldinvoice = $invoice->invoiceno;
                    $split = explode('-',$oldinvoice); 
                    $invno = $split[4]; 
                    $numsplit = explode('0',$invno); 
                    $incnum = $numsplit[6] + 1;
                    $invoiceno = 'INV'.'-'.'DAZLKN'.'-'.$year.'-'.$month.'-'.'000000'.$incnum;
                }


                if (empty($order)) {
                     $orderno = 'ORD'.'-'.'DAZLKN'.'-'.$year.'-'.$month.'-'.'0000001'; 
                } else {
                    $oldorder = $order->orderno;
                    $split = explode('-',$oldorder); 
                    $ordno = $split[4]; 
                    $numsplit1 = explode('0',$ordno); 
                    $incnum1 = $numsplit1[6] + 1;
                    $orderno = 'ORD'.'-'.'DAZLKN'.'-'.$year.'-'.$month.'-'.'000000'.$incnum1;
                }




                $payment_type = $request->paymenttype;

                $order = new Orders();
                $order->user_id = $loggedinId;
                $order->invoice_id = null;
                $order->orderno = $orderno;
                $order->paymenttype = $request->paymenttype;
                $order->status = "Ordered";
                $order->save();

                if ($addrsave == 1) {
                    $objaddress = new Addresses();
                    $objaddress->title = 'New Address';
                    $objaddress->userid = $loggedinId;
                    $objaddress->address1 = $request->address1;
                    $objaddress->address2 = $request->address2;
                    $objaddress->towncity = $request->city;
                    $objaddress->countryid = $request->countryid;
                    $objaddress->zipcode   = $request->pocode;
                    $objaddress->save();
                }

                $carts = Carts::select('carts.productId','carts.quantity','products.product_price','products.product_name')
                         ->join('products', 'carts.productId', '=', 'products.Id')
                         ->where('carts.UserId','=',$loggedinId)
                         ->get();
                foreach ($carts as $cart) {
                  $productdet = Products::where('Id','=',$cart->productId)->first();
                    if (!empty($productdet->current_quantity)) {
                     $quantity = $productdet->current_quantity;
                    } else {
                      $quantity = $productdet->product_quantity;
                    }

                    $current_qty = $quantity - $cart->quantity;
              Session::put('$current_qty',$current_qty);
                 Session::put('productId',$cart->productId);
                 
                  

                    $suborder = new suborders();
                    $suborder->product_id = $cart->productId;
                    $suborder->order_id = $order->id;
                    $suborder->price = $cart->product_price;
                    $suborder->quantity = $cart->quantity;
                    $suborder->save();
                }


                


                $invoice = new Invoice();
                $invoice->orderid = $order->id;
                $invoice->invoiceno = $invoiceno;
                $invoice->customer_email = $request->mail;
                $invoice->customer_id =  $loggedinId;
                $invoice->country_code = $details->country;
                $invoice->payment_id = $request->paymentId;
                $invoice->currency = $currency;
                $invoice->payment_status = "paid";
                $invoice->price = $request->finalamt;
                $invoice->shipping_amt = $request->shippingamt;
                $invoice->tax = $request->taxamt;
                $invoice->save();

                $appliedcoupon = Session::get('couponcode'); 

                if (!empty($appliedcoupon)) {
                    $coupondata = Coupons::where('code','=',$appliedcoupon)->first();

                    $coupons = new Usercoupons();
                    $coupons->orderid = $order->id;
                    $coupons->userid = $loggedinId;
                    $coupons->couponid = $coupondata->id;
                    $coupons->save();


                }


                $order = Orders::find($order->id);
                $order->invoice_id = $invoiceno;
                $order->save();



                $billingdetail = new Billingdetails();
                $billingdetail->orderid = $order->id;
                $billingdetail->first_name = $request->fname;
                $billingdetail->last_name =  $request->lname;
                $billingdetail->mail = $request->mail;
                $billingdetail->phone = $request->phone;
                $billingdetail->countryid = $request->countryid;
                $billingdetail->address1 = $request->address1;
                $billingdetail->address2 = $request->address2;
                $billingdetail->city = $request->city;
                $billingdetail->pocode = $request->pocode;
                $billingdetail->notes = $request->note;
                $billingdetail->save();


                $shippingaddress = new Shippingaddress();
                $shippingaddress->orderid = $order->id;
                $shippingaddress->first_name = $request->shipfname;
                $shippingaddress->last_name =  $request->shiplname;
                $shippingaddress->mail = $request->shipmail;
                $shippingaddress->phone = $request->shipphone;
                $shippingaddress->countryid = $request->scountryid;
                $shippingaddress->address1 = $request->shipaddress1;
                $shippingaddress->address2 = $request->shipaddress2;
                $shippingaddress->city = $request->shipcity;
                $shippingaddress->pocode = $request->shippocode;
                $shippingaddress->save();


                $suborders = suborders::where('order_id','=',$order->id)->count();
                $country = Country::where('id','=',$request->countryid)->first();
                $ordersdata = Orders::where('id','=',$order->id)->first();
                $subordersdata = suborders::select('suborders.quantity','suborders.price','products.product_name')
                                  ->join('products', 'suborders.product_id', '=', 'products.Id')
                                 ->where('order_id','=',$order->id)->get();
            

                $subject = "Order Placed";

                $email_data = array(
                    'orderno'=>$orderno,
                    'invoiceno'=>$invoiceno,
                    'amount'=>$request->finalamt - $request->shippingamt,
                    'shippingamt'=>$request->shippingamt,
                    'grandtotal'=>$request->finalamt,
                    'address1'=>$request->address1,
                    'address2'=>$request->address2,
                    'city'=>$request->city,
                    'country'=>$country->country_name,
                    'pocode'=>$request->pocode,
                    'itemcount' =>$suborders,
                    'orderdate' =>$ordersdata->created_at,
                    'suborders' =>$subordersdata
                    );

                $email = Auth::user()->email;
                 Session::put('orderno',$orderno);
                 Session::put('invoiceno',$invoiceno);
            Session::put('amount',$request->finalamt - $request->shippingamt);
                 Session::put('shippingamt',$request->shippingamt);
                 Session::put('grandtotal',$request->finalamt);
                 Session::put('address1',$request->address1);
                 Session::put('address2',$request->address2);
                 Session::put('city',$request->city);
                 Session::put('country',$country->country_name);

                  Session::put('pocode',$request->pocode);
                 Session::put('itemcount',$suborders);
                 Session::put('orderdate',$ordersdata->created_at);
                 Session::put('suborders',$subordersdata);
               
                Session::forget('couponcode');

                 Carts::where('carts.UserId','=',$loggedinId)->delete();

                 if ($payment_type == 'paypal') {
                     return redirect('customer/checkout/'.Crypt::encrypt($order->id));
                 } else {
                    return redirect('customer/cardpaymentpage/'.Crypt::encrypt($order->id));
                 }

                

            }
    }



    public function cardpaymentpage($id)
    {
        $id = Crypt::decrypt($id);
         $data['orders'] = Orders::select('orders.id','orders.orderno','invoice.price','orders.status','invoice.id as Invoiceid')
                          ->join('invoice', 'orders.id', '=', 'invoice.orderid')
                          ->where('orders.id','=',$id)
                          ->first(); 
        return view('frontent/cardpayment',$data);
    }



    public function validatecoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'couponcode'     => 'required',
            ]);
        if ($validator -> fails()) {
                return back()->withErrors($validator)->withInput();
        } else {
            $loggedinId = Auth::user()->id;
            $coupons = $request->couponcode;
            $today = date("Y-m-d");  
            $coupondata = Coupons::where('code','=',$coupons)
                          ->where('to', '>', $today)
                          ->first(); 
            if (!empty($coupondata)) {
                Session::put('couponcode', $coupons);
                Session::flash('message', 'Coupon added successfully!!');
            } else {
                Session::flash('error', 'Invalid Coupon Code!!');
            }


            
            return redirect('customer/checkout');
            
        } 



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orderid = Crypt::decrypt($id); 
        $orders = Orders::where('id','=',$orderid)->first();
        $invoiceid = $orders->invoice_id; 

        $data['invoice'] = Invoice::where('invoiceno','=',$invoiceid)->first();
        return view('frontent/ordersuccess',$data);
    }



    public function cardpayment(Request $request)
    {
        // $store_id='store5';
        // $api_token='yesguy'; 
     
          $store_id='gwca039157';
        $api_token='Q7Dm89P9K0t8wNiF8Vmt'; 
        if(Auth::user()){
            $loggedinId = Auth::user()->id;
        } else {
            $loggedinId = Session::get('sessionid');
        }

         

         $fullexpiry = $request->expdate;

         $splitexpiry = explode('-', $fullexpiry);

         $exp_month = $splitexpiry[1];
         $exp_year  = $splitexpiry[0];

         $substryear = substr($exp_year,2);

         $expiry_date = $exp_month. $substryear;

         $invoiceid = $request->invoiceid;
         $orderid = $request->orderid;
        //   return $request->invoiceid;
        /************************* Transactional Variables ****************************/

        // $type='purchase';
        // $cust_id=$loggedinId;
        // $order_id=$request->orderid;
        // $amount=$request->price;
        // $pan=$request->cardno;
        // $expiry_date=$expiry_date;
        // $crypt='7';
        // $dynamic_descriptor='123';
        // $status_check = 'false';

        $type='purchase';
        $cust_id=$loggedinId;
        $order_id='ord-'.date("dmy-G:i:s");
        $amount=$request->price.'.00';
        $pan=$request->cardno;
        $expiry_date=$expiry_date;
        $crypt='7';
        $dynamic_descriptor='123';
        $status_check = 'false';


        $txnArray=array('type'=>$type,
                'order_id'=>$order_id,
                'cust_id'=>$cust_id,
                'amount'=>$amount,
                'pan'=>$pan,
                'expdate'=>$expiry_date,
                'crypt_type'=>$crypt,
                'dynamic_descriptor'=>$dynamic_descriptor
                //,'wallet_indicator' => '' //Refer to documentation for details
                //,'cm_id' => '8nAK8712sGaAkls56' //set only for usage with Offlinx - Unique max 50 alphanumeric characters transaction id generated by merchant
               );
         $mpgTxn = new mpgTransaction($txnArray); 

        $cof = new CofInfo();
        $cof->setPaymentIndicator("U");
        $cof->setPaymentInformation("2");
        $cof->setIssuerId("168451306048014");

        $mpgTxn->setCofInfo($cof);

        $mpgRequest = new mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        $mpgRequest->setTestMode(true); //false or comment out this line for production transactions

        $mpgHttpPost = new mpgHttpsPost($store_id,$api_token,$mpgRequest); 


        $mpgResponse=$mpgHttpPost->getMpgResponse(); 
        // $response = $mpgHttpPost->response;
        // return $response;

         $transactionref = $mpgResponse->getReferenceNum(); 

  $mpgResponse->getCardType();

        if($transactionref =='null'){
      return Redirect::back()->withErrors(['msg', 'Please enter valid card number']);
}
else{
  
     $invoice = Invoice::find($invoiceid);
        $invoice->payment_id = $transactionref;
        $invoice->save();
        
        
          $productqty = Products::find(Session::get('productId'));
          
          $count=  $productqty->product_quantity-1;
          
                    $productqty->product_quantity = $count; 
                    $productqty->save();
  $subject = "Order Placed";

                $email_data = array(
                    'orderno'=>Session::get('orderno'),
                    'invoiceno'=>Session::get('invoiceno'),
                    'amount'=>Session::get('amount'),
                    'shippingamt'=>Session::get('shippingamt'),
                    'grandtotal'=>Session::get('grandtotal'),
                    'address1'=>Session::get('address1'),
                    'address2'=>Session::get('address2'),
                    'city'=>Session::get('city'),
                    'country'=>Session::get('country'),
                    'pocode'=>Session::get('pocode'),
                    'itemcount' =>Session::get('itemcount'),
                    'orderdate' =>Session::get('orderdate'),
                    'suborders' =>Session::get('suborders')
                    );

                $email = Auth::user()->email;
             
                Mail::to($email)->send(new ordermail($subject,$email_data));
                Mail::to($email)->send(new invoicemail($email_data));
         return redirect('customer/checkout/'.Crypt::encrypt($orderid));
   
}

        // print("\nCardType = " . $mpgResponse->getCardType());
        // print("\nTransAmount = " . $mpgResponse->getTransAmount());
        // print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
        // print("\nReceiptId = " . $mpgResponse->getReceiptId());
        // print("\nTransType = " . $mpgResponse->getTransType());
        // print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
        // print("\nResponseCode = " . $mpgResponse->getResponseCode());
        // print("\nISO = " . $mpgResponse->getISO());
        // print("\nMessage = " . $mpgResponse->getMessage());
        // print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
        // print("\nAuthCode = " . $mpgResponse->getAuthCode());
        // print("\nComplete = " . $mpgResponse->getComplete());
        // print("\nTransDate = " . $mpgResponse->getTransDate());
        // print("\nTransTime = " . $mpgResponse->getTransTime());
        // print("\nTicket = " . $mpgResponse->getTicket());
        // print("\nTimedOut = " . $mpgResponse->getTimedOut());
        // print("\nStatusCode = " . $mpgResponse->getStatusCode());
        // print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
        // print("\nHostId = " . $mpgResponse->getHostId());
        // print("\nIssuerId = " . $mpgResponse->getIssuerId());

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
