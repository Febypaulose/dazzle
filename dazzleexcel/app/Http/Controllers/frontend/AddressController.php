<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\model\Country;
use App\model\Addresses;

use Session;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['addresses'] = Addresses::all();
        return view('frontent/addresses',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['country'] = Country::all();
         $data['edit'] = 0;
         return view('frontent/addaddress',$data);
    }


    public function getaddress(Request $request)
    {
        $addressid = $request->id;
        $loggedinId = Auth::user()->id;
        $adress = Addresses::where('id','=',$addressid)
        ->where('userid','=',$loggedinId)
        ->first(); 
         return response()->json($adress);
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
                'address1'     => 'required',
                'address2'     => 'required',
                'towncity'     => 'required',
                'countryid'    => 'required',
                'zipcode'      => 'required',
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $loggedinId = Auth::user()->id;

            $objaddress = new Addresses();
            $objaddress->title = $request->titleaddr;
            $objaddress->userid = $loggedinId;
            $objaddress->address1 = $request->address1;
            $objaddress->address2 = $request->address2;
            $objaddress->towncity = $request->towncity;
            $objaddress->countryid = $request->countryid;
            $objaddress->zipcode   = $request->zipcode;
            $objaddress->default_address = $request->def_addr;
            $objaddress->save();

            Session::flash('message', 'Address added successfully!!');
            return redirect('customer/addresses');
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
        $data['country'] = Country::all();
        $loggedinId = Auth::user()->id;
        $data['address'] = Addresses::where('id','=',$id)
        ->where('userid','=',$loggedinId)
        ->first(); 
        $data['edit'] = 1;

        return view('frontent/addaddress',$data);
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
                'address1'     => 'required',
                'address2'     => 'required',
                'towncity'     => 'required',
                'countryid'    => 'required',
                'zipcode'      => 'required',
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {

            $id     = Crypt::decrypt($id);
            $loggedinId = Auth::user()->id;

            $objaddress = Addresses::find($id);
            $objaddress->title = $request->titleaddr;
            $objaddress->userid = $loggedinId;
            $objaddress->address1 = $request->address1;
            $objaddress->address2 = $request->address2;
            $objaddress->towncity = $request->towncity;
            $objaddress->countryid = $request->countryid;
            $objaddress->zipcode   = $request->zipcode;
            $objaddress->default_address = $request->def_addr;
            $objaddress->save();

            Session::flash('message', 'Address successfully Updated!!');
            return redirect('customer/addresses');
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
