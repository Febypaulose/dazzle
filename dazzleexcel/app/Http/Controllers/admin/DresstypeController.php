<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\model\Dresstype;
use Session;
class DresstypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['dresstype'] = Dresstype::all(); 
        return view('admin/dresstype/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/dresstype/add-edit',$data);
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
                'dresstype'           => 'required'
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $objdresstype                 = new Dresstype();  
            $objdresstype->dresstype      = $request->dresstype;
            $objdresstype->save(); 

           Session::flash('message', 'Dresstype  Created Successfully!');
           return redirect('manage/dresstype/');
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
        $data['dresstypes'] = Dresstype::where('id','=',$id)->first();
        $data['edit'] = 1;
        return view('admin/dresstype/add-edit',$data);
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
                'dresstype'           => 'required'
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $id     = Crypt::decrypt($id); 

            $objdresstype                 = Dresstype::find($id);  
            $objdresstype->dresstype      = $request->dresstype;
            $objdresstype->save(); 
            Session::flash('message', 'Dresstype Successfully Updated!');
            return redirect('manage/dresstype/');
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
        Dresstype::where('id', '=', $id)->delete();
        Session::flash('message', 'Dress Type Deleted  Successfully!');
        return redirect('manage/dresstype/');
    }
}
