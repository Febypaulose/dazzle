<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

use App\model\Offers;
use App\model\Category;
use App\model\Products;

use Session;

class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['offers'] = Offers::all();
        return view('admin/offers/browse',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['edit'] = 0;
        $data['category'] =Category::where('parentId','=',0)->get();
        return view('admin/offers/add-edit',$data);
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
                'percentage'     => 'required',
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $type = $request->type;
            if ($type == 'wholewebsite') {
                $objoffers                 = new Offers();  
                $objoffers->type           = $request->type;
                $objoffers->percentage     = $request->percentage;
                $objoffers->save(); 
            } else {
                $objoffers                 = new Offers();  
                $objoffers->type           = $request->type;
                $objoffers->parentid       = $request->pcatid;
                $objoffers->categoryid     = $request->catid;
                $objoffers->subcategoryid  = $request->subcatid;
                $objoffers->productid      = $request->productid;
                $objoffers->percentage     = $request->percentage;
                $objoffers->save(); 
            }

            Session::flash('message', 'Offers  Created Successfully!');
           return redirect('manage/offers/');
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
        $data['edit'] = 1;
        $data['offer'] = Offers::where('id','=',$id)->first();
        $categoryid =  $data['offer']->categoryid; 
        $data['category'] =Category::where('parentId','=',0)->get();
        $data['subcategory'] =Category::where('parentId','=',$categoryid )->get();
        $data['maincategory'] =Category::where('parentId','!=',0)->get();
        $data['products'] = Products::all();
        return view('admin/offers/add-edit',$data);
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
                'percentage'     => 'required',
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $type = $request->type;
             $id     = Crypt::decrypt($id);
            if ($type == 'wholewebsite') {
                $objoffers                 = Offers::find($id);  
                $objoffers->type           = $request->type;
                $objoffers->percentage     = $request->percentage;
                $objoffers->save(); 
            } else {
                $objoffers                 = Offers::find($id);  
                $objoffers->type           = $request->type;
                $objoffers->parentid       = $request->pcatid;
                $objoffers->categoryid     = $request->catid;
                $objoffers->subcategoryid  = $request->subcatid;
                $objoffers->productid      = $request->productid;
                $objoffers->percentage     = $request->percentage;
                $objoffers->save(); 
            }

           Session::flash('message', 'Offers Successfully Updated!');
           return redirect('manage/offers/');
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
        Offers::where('id', '=', $id)->delete();
        Session::flash('message', 'Offers Deleted  Successfully!');

        return redirect('manage/offers/');
    }
}
