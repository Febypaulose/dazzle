<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\model\Dressmaterial;
use Session;

class DressmaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['materials'] = Dressmaterial::all();
        return view('admin/material/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/material/add-edit',$data);
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
                'dressmaterial'           => 'required'
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $objdressmat                 = new Dressmaterial();  
            $objdressmat->material       = $request->dressmaterial;
            $objdressmat->save(); 

           Session::flash('message', 'Dressmaterial  Created Successfully!');
           return redirect('manage/dressmaterial/');
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
        $data['materials'] = Dressmaterial::where('id','=',$id)->first();
        $data['edit'] = 1;
        return view('admin/material/add-edit',$data);
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
                'dressmaterial'           => 'required'
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $id     = Crypt::decrypt($id);

            $objdressmat                 = Dressmaterial::find($id);  
            $objdressmat->material       = $request->dressmaterial;
            $objdressmat->save(); 

          Session::flash('message', 'Dressmaterial Successfully Updated!');
           return redirect('manage/dressmaterial/');
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
        Dressmaterial::where('id', '=', $id)->delete();
        Session::flash('message', 'Dressmaterial Deleted  Successfully!');
        return redirect('manage/dressmaterial/');
    }
}
