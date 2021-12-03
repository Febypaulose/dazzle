<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;



use App\model\Coupons;
use Session;

class Couponscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['coupons'] = Coupons::all();
       return view('admin/coupons/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/coupons/add-edit',$data);
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
                'type'           => 'required',
                'exdate'         => 'required'
            ]);


        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $type = $request->type;
            $objcoupons                 = new Coupons();  
            $objcoupons->type       = $type;
            $objcoupons->code       = $request->couponcode;
            if ($type == 'fixed') {
                $objcoupons->value       = $request->fixedvalue;
            } else if($type == 'percent') {
                $objcoupons->percent_off       = $request->percentage;
            }
            $objcoupons->to       = $request->exdate;
            $objcoupons->save(); 

             Session::flash('message', 'Coupons  Created Successfully!');
           return redirect('manage/coupons/');
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
        $id     = Crypt::decrypt($id);
        $data['coupons'] = Coupons::where('id','=',$id)->first();
        $data['edit'] = 1;
         return view('admin/coupons/add-edit',$data);
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
                'type'           => 'required',
                'exdate'         => 'required'
            ]);


        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $id     = Crypt::decrypt($id);
            $type = $request->type;
            $objcoupons                 = Coupons::find($id);  
            $objcoupons->type       = $type;
            $objcoupons->code       = $request->couponcode;
            if ($type == 'fixed') {
                $objcoupons->value       = $request->fixedvalue;
            } else if($type == 'percent') {
                $objcoupons->percent_off       = $request->percentage;
            }
            $objcoupons->to       = $request->exdate;
            $objcoupons->save(); 

             Session::flash('message', 'Coupons Successfully Updated!');
           return redirect('manage/coupons/');
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
        $id     = Crypt::decrypt($id);
        Coupons::where('Id', '=', $id)->delete();
        Session::flash('message', 'Coupons Deleted  Successfully!');

        return redirect('manage/coupons/');
    }
}
