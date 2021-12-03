<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


use App\model\Size;
use Session;


class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sizes'] = Size::all();
        return view('admin/size/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['edit'] = 0;
         return view('admin/size/add-edit',$data);
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
                'sizename'           => 'required',
            ]);
        if ($validator -> fails()) {
             return back()->withErrors($validator)->withInput();
        } else {
            $objcolours                 = new Size();  
            $objcolours->size           = $request->sizename;
            $objcolours->save(); 

            Session::flash('message', 'Size  Created Successfully!');
           return redirect('manage/size/');
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
        $data['sizes'] = Size::where('id','=',$id)->first();
        $data['edit'] = 1;
        return view('admin/size/add-edit',$data);
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
                'sizename'           => 'required',
            ]);
        if ($validator -> fails()) {
             return back()->withErrors($validator)->withInput();
        } else {
            $id     = Crypt::decrypt($id); 
            $objcolours                 = Size::find($id);  
            $objcolours->size           = $request->sizename;
            $objcolours->save(); 

            Session::flash('message', 'Size Successfully Updated!');
           return redirect('manage/size/');
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
        Size::where('id', '=', $id)->delete();
        Session::flash('message', 'Size Deleted  Successfully!');
        return redirect('manage/size/');
    }
}
