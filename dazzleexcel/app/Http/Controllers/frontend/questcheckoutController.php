<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


use App\model\Country;
use App\model\guestcart;
use App\model\Orders;
use App\model\suborders;
use App\model\Invoice;
use App\model\Billingdetails;
use App\model\Shippingaddress;
use App\model\Accounts;
use App\model\Addresses;
use App\model\Coupons;
use App\model\Usercoupons;
use App\model\Products;
use App\User;


use App\Mail\ordermail;
use App\Mail\invoicemail;
use App\Mail\WelcomeEmail;


use Crypt;
use Session;

class questcheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $loggedinId = Session::get('sessionid'); 
        $data['country'] = Country::all();
        $data['carts'] = guestcart::select('quest_cart.productid','quest_cart.quantity','products.product_price','products.product_name','quest_cart.id')
                         ->join('products', 'quest_cart.productId', '=', 'products.Id')
                         ->where('quest_cart.sessionid','=',$loggedinId)
                         ->get();
        return view('frontent/questcheckout',$data);
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
        
            $addrsave = $request->addr_save;
            $currency = env('BASE_CURR');
            $invoice = Invoice::latest()->first();

            $order = Orders::latest()->first();

            $year = date("Y"); 
            $month = date("m"); 

            $ip = '116.68.68.116';
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}")); 

            $fullname = $request->fname.' '.$request->lname;

             $user = User::create([
            'name' => $fullname,
            'email' => $request->mail,
            'phone' => $request->phone,
            'password' => bcrypt($request->pass),
            'usertype' => 'customer',
            ]);

            $loggedinId = $user->id;


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

                $sessionid = Session::get('sessionid');
                $carts = guestcart::select('quest_cart.productid','quest_cart.quantity','products.product_price','products.product_name','quest_cart.id')
                         ->join('products', 'quest_cart.productId', '=', 'products.Id')
                         ->where('quest_cart.sessionid','=',$sessionid)
                         ->get(); 

                foreach ($carts as $cart) {
                
                    $productdet = Products::where('Id','=',$cart->productid)->first();
                    if ($productdet->current_quantity == 0) {
                     $squantity = $productdet->current_quantity;
                    } else {
                      $squantity = $productdet->product_quantity;
                    }

                    $current_qty = $squantity - $cart->quantity; 

                    $productqty = Products::find($cart->productid);
                    $productqty->current_quantity = $current_qty;
                    $productqty->save();


                    $suborder = new suborders();
                    $suborder->product_id = $cart->productid;
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

                $email_dataorder = array(
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

                $email = $request->mail;
                

                Session::forget('couponcode');
                $loggedinId = Session::get('sessionid'); 
                guestcart::where('sessionid','=',$loggedinId)->delete();



             $email_data = array(
            'name'=> $fullname,
            );

            Mail::to($email)->send(new WelcomeEmail($email_data)); 

            Mail::to($email)->send(new ordermail($subject,$email_dataorder));
            Mail::to($email)->send(new invoicemail($email_dataorder));

            Session::forget('type');
            Session::forget('page');

             if ($payment_type == 'paypal') {
                     return redirect('customer/checkout/'.Crypt::encrypt($order->id));
             } else {
                    return redirect('customer/cardpaymentpage/'.Crypt::encrypt($order->id));
             }
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
        //
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
