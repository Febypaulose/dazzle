<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;


use App\model\Colours;
use Session;


class ColourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['colours'] = Colours::all();
        return view('admin/colours/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        return view('admin/colours/add-edit',$data);
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
                'colorname'           => 'required',
                'colorcode'           => 'required',
            ]);
        if ($validator -> fails()) {
             return back()->withErrors($validator)->withInput();
        } else {
            $objcolours                 = new Colours();  
            $objcolours->color_name       = $request->colorname;
            $objcolours->color_code       = $request->colorcode;
            $objcolours->save(); 

            Session::flash('message', 'Colour  Created Successfully!');
           return redirect('manage/colours/');
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
        $data['colour'] = Colours::where('id','=',$id)->first();
        $data['edit'] = 1;
        return view('admin/colours/add-edit',$data);
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
                'colorname'           => 'required',
                'colorcode'           => 'required',
        ]);

        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $id     = Crypt::decrypt($id); 
            // $objcolours                   = Colours::find($id);  
            // $objcolours->color_name       = $request->colorname;
            // $objcolours->color_code       = $request->colorcode;
            // $objcolours->save(); 
            $valupd = array(
                        'color_name' =>$request->colorname,
                        'color_code' =>$request->colorcode
                        ); 
            Colours::where('id',$id)->update($valupd);

           Session::flash('message', 'Colour Successfully Updated!');
           return redirect('manage/colours/');
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
        Colours::where('id', '=', $id)->delete();
        Session::flash('message', 'Colour Deleted  Successfully!');
        return redirect('manage/colours/');
    }
}
