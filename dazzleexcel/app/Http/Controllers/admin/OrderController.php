<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use App\model\Orders;

use App\Mail\orderstatus;
use App\model\suborders;
use App\model\Invoice;
use App\model\Billingdetails;
use App\model\Ordershipping;

use Session;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['orders'] = Orders::with([
                          'invoiceselect'  => function ($query) {
                           $query->select('id','shipping_amt','price');},
                          'userselect'  => function ($query) {
                           $query->select('id','name');}
        ])->get(); 
        return view('admin/orders/browse',$data);
    }


    public function updatestatus(Request $request)
    {
        $orderid = $request->orderid;
        $status = $request->statusid;
        $orders = Orders::select('orders.orderno','users.name','users.email','orders.shippingtype')
                  ->join('users', 'orders.user_id', '=', 'users.id')
                  ->where('orders.id','=',$orderid)
                  ->first();

        $shiptype = $orders->shippingtype;
        $ordertracking = Ordershipping::select('shippingtype','trackingcode','tracking_url')
                             ->where('orderid','=',$orderid)
                             ->where('shippingtype','=',$shiptype)
                             ->first();


        $oborderupdate          = Orders::find($orderid);  
        $oborderupdate->status  = $status;
        $oborderupdate->ordernote  = $request->ordernote;
        $oborderupdate->save(); 
        $ordno = '#'.$orders->orderno;


        if ($status == 'Shipped') {

            $link = $ordertracking ->tracking_url;
            $message =" Your order with Order No ".$ordno." has been ".$status." and your tracking code is ".$ordertracking->trackingcode." ";
            // $objshipment                 = new Ordershipping();  
            // $objshipment->orderid      = $orderid;
            // $objshipment->shippingtype = 'canadapost';
            // $objshipment->shipmentid   = $request->shipmentId;
            // $objshipment->trackingcode = $request->trackingId;
            // $objshipment->save(); 
        } else {
            $link = '';
            $message =" Your order with Order No ".$ordno." has been ".$status." ";
        }
        $email_data = array(
                    'orderno'=>$orders->orderno,
                    'status'=>$status,
                    'name'=>$orders->name,
                    'message' =>$message,
                    'link' =>$link
                    );
        $subject = "Order Status";
        Mail::to($orders->email)->send(new orderstatus($subject,$email_data));
        Session::flash('message', 'Order Status Successfully Updated  !');
        return redirect('manage/orders');
    }


    public function updateshippingmethod(Request $request)
    {
        $orderid = $request->orderid;
        $shipping = $request->shipping;

        $oborderupdate          = Orders::find($orderid);  
        $oborderupdate->shippingtype  = $shipping;
        $oborderupdate->save(); 

         $objshipment                 = new Ordershipping();  
         $objshipment->orderid      = $orderid;
         $objshipment->shippingtype = $request->shipping;
         $objshipment->trackingcode = $request->trackingcode;
         $objshipment->tracking_url = $request->trackingurl;
         $objshipment->save(); 

        Session::flash('message', 'Shipping Successfully Updated  !');
        return redirect('manage/orders');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id     = Crypt::decrypt($id);

        $data['order'] = Orders::select('orderno','invoice_id','status','created_at')
                         ->where('orders.id','=',$id)
                         ->first();
        $data['billing'] = Billingdetails::join('countries', 'billingaddress.countryid', '=', 'countries.id')
                           ->select('billingaddress.first_name','billingaddress.last_name','billingaddress.address1','billingaddress.address2','billingaddress.city','billingaddress.pocode','countries.country_name','billingaddress.phone')
                           ->where('billingaddress.orderid','=',$id)
                           ->first();
        $data['suborders'] = suborders::select('suborders.quantity','suborders.price','products.product_name')
                             ->join('products', 'suborders.product_id', '=', 'products.Id')
                             ->where('order_id','=',$id)
                             ->get();
        $data['invoice'] = Invoice::select('shipping_amt','price')
                           ->where('orderid','=',$id)
                           ->first();
        return view('admin/orders/view',$data);
    }



    public function updateorderstatus($id)
    {
        $id     = Crypt::decrypt($id);
        $data['orderid'] = $id;
        $data['order'] = Orders::select('status','shippingtype')
                         ->where('orders.id','=',$id)
                         ->first();
        return view('admin/orders/order-status',$data);
    }



    public function updateordershipping($id)
    {
        $id     = Crypt::decrypt($id);
        $data['orderid'] = $id;
        $data['order'] = Orders::select('status')
                         ->where('orders.id','=',$id)
                         ->first();
        return view('admin/orders/shipping-update',$data);
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
