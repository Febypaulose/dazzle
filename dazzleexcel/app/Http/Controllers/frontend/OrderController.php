<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\ordermail;

use App\model\Orders;
use App\model\suborders;
use App\model\Invoice;
use App\model\Billingdetails;
use App\model\Shippingaddress;
use App\model\Usercoupons;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedinId = Auth::user()->id;
        $data['orders'] = Orders::select('orders.id','orders.orderno','invoice.price','orders.status')
                          ->join('invoice', 'orders.id', '=', 'invoice.orderid')
                          ->where('orders.user_id','=',$loggedinId)
                          ->get();
        return view('frontent/orders',$data);
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
        $data['invoice'] = Orders::select('orderno','paymenttype','created_at')->where('id','=',$id)->first();
        $data['billing'] = Billingdetails::select('billingaddress.first_name','billingaddress.last_name','billingaddress.phone','billingaddress.address1','billingaddress.address2','billingaddress.city','countries.country_name','billingaddress.pocode','billingaddress.mail')
                           ->join('countries', 'billingaddress.countryid', '=', 'countries.id')
                           ->where('billingaddress.orderid','=',$id)
                           ->first(); 
        $data['shipping'] = Shippingaddress::select('shippingaddress.first_name','shippingaddress.last_name','shippingaddress.phone','shippingaddress.address1','shippingaddress.address2','shippingaddress.city','countries.country_name','shippingaddress.pocode','shippingaddress.mail')
                           ->join('countries', 'shippingaddress.countryid', '=', 'countries.id')
                           ->where('shippingaddress.orderid','=',$id)
                           ->first();
        $data['items'] = suborders::select('products.product_name','suborders.quantity','suborders.price')
                         ->join('products', 'suborders.product_id', '=', 'products.Id')
                         ->where('order_id','=',$id)
                         ->get();
        $data['invoicelist'] = Invoice::select('shipping_amt','price','tax')
                           ->where('orderid','=',$id)
                           ->first();
        $data['coupondata'] = Usercoupons::select('coupons.code','coupons.type','coupons.value','coupons.percent_off')
                              ->join('coupons', 'usercoupons.couponid', '=', 'coupons.id')
                              ->where('usercoupons.orderid','=',$id)
                              ->first();
        return view('frontent/orderinvoice',$data);
        
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
