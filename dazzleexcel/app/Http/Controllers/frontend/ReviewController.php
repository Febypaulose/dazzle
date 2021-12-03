<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\model\Reviews;
use App\model\Orders;
use App\model\Products;

use Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $productid = $request->productid; 
        if(!Auth::check()){
            Session::put('parameters', $productid);
             Session::put('page', "productdetail");
             Session::put('pagetype', "productdetail");
             return redirect('loginregister');
           
        } else {
              $userid = Auth::user()->id;
        }
        
        $orders = Orders::join('suborders', 'orders.id', '=', 'suborders.order_id')
                  ->where('suborders.product_id','=',$productid)
                  ->where('orders.user_id','=',$userid)
                  ->count(); 
        $products = Products::where('Id','=',$productid)->first();
        if ($orders == 0) {
           Session::flash('error', 'can review product only after purchasing!!');
            $idencript = Crypt::encrypt($productid);
            if ($products->product_type == 'normal') {
               return redirect('productdetail/'.$idencript);
            } else {
                return redirect('luxury/'.$idencript);
            }
        } else {
             $validator = Validator::make($request->all(), [
                'fullname'     => 'required',
                'summary'     => 'required',
                'star'     => 'required',
            ]);
             if ($validator -> fails()) {
                 return back()->withErrors($validator)->withInput();
             } else {
                $loggedinId = Auth::user()->id;

                $objreviews = new Reviews();
                $objreviews->userid = $loggedinId;
                $objreviews->productid = $productid;
                $objreviews->name = $request->fullname;
                $objreviews->summary = $request->summary;
                $objreviews->rating = $request->star;
                $objreviews->save();

                Session::flash('message', 'Reviews added successfully!!');
                $idencript = Crypt::encrypt($productid);
                if ($products->product_type == 'normal') {
                   return redirect('productdetail/'.$idencript);
                } else {
                    return redirect('luxury/'.$idencript);
                }
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
