<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Mail\Customdesignmail;  


use App\model\Dresstype;
use App\model\Dressmaterial;
use App\model\Colours;
use App\model\Customdesign;
use App\model\Customcolor;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

use Session;

class CustomdesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customdesigns'] = Customdesign::with(
                           [
                           'dresstypeselect'  => function ($query) {
                           $query->select('id','dresstype');}
                           ])->get();

        return view('admin/customdesign/browse',$data);
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
         $id   = Crypt::decrypt($id); 
         $data['customdesign'] = Customdesign::with(
                           [
                           'dresstypeselect'  => function ($query) {
                           $query->select('id','dresstype');},
                           'dressmaterialselect'  => function ($query) {
                           $query->select('id','material');}
                           ])->where('id', '=', $id)
                           ->first(); 
         $data['colours'] = Customcolor::leftjoin('colours', 'customizecolor.color_id', '=', 'colours.id')
                            ->select('colours.color_name')
                            ->where('custom_id', '=', $id)
                            ->get();
         return view('admin/customdesign/view',$data);
    }



    public function paycustom($id)
    {

         $id     = Crypt::decrypt($id);
         $data['customdesign'] = Customdesign::with(
                           [
                           'dresstypeselect'  => function ($query) {
                           $query->select('id','dresstype');},
                           'dressmaterialselect'  => function ($query) {
                           $query->select('id','material');}
                           ])->where('id', '=', $id)
                           ->first(); 
          return view('frontent/custompayment',$data);
    }


    public function updatepayment(Request $request)
    {
        $objcustomize                 = Customdesign::find($request->customdesignid);  
        $objcustomize->paymentid      = $request->paymentid;
        $objcustomize->save(); 

        $request->session()->put('transactionid',$request->paymentid);

         return redirect('custompaymentsuccess');
    }

     public function paymentsuccess(Request $request)
     {
         $data['transactionid'] = $request->session()->get('transactionid');
         return view('frontent/customordersuccess',$data);
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
        $validator = Validator::make($request->all(), [
            'amount'      => 'required',
        ]);

        if ($validator -> fails()) {
           return back()->withErrors($validator)->withInput();
        } else {
             $id     = Crypt::decrypt($id);
             $objcustomize                 = Customdesign::find($id);  
             $objcustomize->amount         = $request->amount;
             $objcustomize->save(); 

             $designcustom = Customdesign::where('id', '=', $id)->first();

             $mail = $designcustom->mail;

             $link = url('custompayment'.'/'.Crypt::encrypt($id));
              $email_data = array(
                'name'=>$designcustom->name,
                'amount'=>$request->amount,
                'link' => $link,
                );
            $subject = "Custom Dress Design Payment | Dazzleknots";
            Mail::to($mail)->send(new Customdesignmail($subject,$email_data)); 

        Session::flash('message', 'Amount in custom Design Successfully Updated  !');
        return redirect('manage/customdesigning');


        }
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
