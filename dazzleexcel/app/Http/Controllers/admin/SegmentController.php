<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\model\Products;
use App\model\Segmenttype;
use App\model\Segments;

use Session;

class SegmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['products'] = Products::where('product_status','=','enabled')->get();
         $data['Segmenttype'] = Segmenttype::all();
         return view('admin/segments/browse',$data);
    }


    public function addtosegment(Request $request)
    {
        $segment = Segments::where('productId','=',$request->productId)->get();
        if (!empty($request->productId)) {
             Segments::where('productId', $request->productId)->delete();
        }
        $typeid = $request->type_id;
        $productid = $request->productId;

         $objaddsegments                     = new Segments(); 
         $objaddsegments->segmenttypeId      = $typeid;
         $objaddsegments->productId          = $productid;
         //$objaddsegments->save();
          

        if ($objaddsegments->save()) {
             return response()->json(['data' => $productid, 'success' => true, 'message' => 'Products Added to Segment'], 200);
        } else {
       return response()->json(['success' => false, 'message' => 'error'], 422);
       }
        Session::flash('message', 'Products Added to Segment!');
        // return redirect('manage/segments');

         //Session::flash('message', 'Products Added to Segment!');
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
        dd($request);
        $typeId = $request->typeId;dd($typeId);
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
       $id     = Crypt::decrypt($id);
       Segments::where('productId', $id)->delete();
        Session::flash('message', 'Product Segment Deleted  Successfully!');
        return redirect('manage/segments');
    }
}
