<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\model\Testimonials;

use Session;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontent/testimonial');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function testimonialhome()
    {
        $data['testimonial'] =Testimonials::join('users', 'testimonials.userid', '=', 'users.id')
                              ->select('users.name','testimonials.image','testimonials.message')
                             ->get();
        return view('frontent/testimonialfrontend',$data);
    }
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
       $validator = Validator::make($request->all(), [
            'message'           => 'required',
            'image'           => 'required',
        ]);

        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->image) {
                    $filenameWithExt =$request->image->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->image->getClientOriginalExtension();
                    $fileNameToStore = time().rand(100,999).'.'.$extension;
                    $path = $request->image->storeAs('public/testimonials',$fileNameToStore);               
           }

            $loggeduserId = Auth::id(); 
            $objtestimonial                   = new Testimonials(); 
            $objtestimonial->userid           = $loggeduserId;
            $objtestimonial->image            = $fileNameToStore;
            $objtestimonial->message          =$request->message;
            $objtestimonial->status           ='0';
            $objtestimonial->save(); 

            Session::flash('message', 'Testimonial Successfully Created!');
         return redirect('customer/testimonials');
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
