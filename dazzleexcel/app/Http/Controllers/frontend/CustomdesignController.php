<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Mail\customdesignadminemail;  

use App\model\Dresstype;
use App\model\Dressmaterial;
use App\model\Colours;
use App\model\Customdesign;
use App\model\Customcolor;


use Session;

class CustomdesignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['dresstype'] = Dresstype::all(); 
        $data['colours'] = Colours::all();
        $data['materials'] = Dressmaterial::all();
        return view('frontent/customize',$data);
    }


    public function customize()
    {
        return view('frontent/customize');
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
        $validator = Validator::make($request->all(), [
                'fullname'       => 'required',
                'mail'           => 'required',
                'phone'          => 'required',
                'paytype'        => 'required',
                'typeId'         => 'required',
                'color'          => 'required',
                'materialid'     => 'required',
                'handwork'       => 'required',
                'design'         => 'required',
                'ptime'          => 'required',
                'pdate'          => 'required'
            ]);
        if ($validator -> fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            if ($request->design) {
                    $filenameWithExt =$request->design->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $request->design->getClientOriginalExtension();
                    $fileNameToStore = time().rand(100,999).'.'.$extension;
                    $path = $request->design->storeAs('public/customdesign',$fileNameToStore);               
           }

            $objcustomize                 = new Customdesign();  
            $objcustomize->name           = $request->fullname;
            $objcustomize->mail           = $request->mail;
            $objcustomize->phone          = $request->phone;
            if (!empty(Auth::user())) 
            {
                $objcustomize->userid   = $request->userid;
            }
            $objcustomize->dresstype_id   = $request->typeId;
            $objcustomize->material_id    = $request->materialid;
            $objcustomize->handwork       = $request->handwork;
            $objcustomize->design         = $fileNameToStore;
            $objcustomize->paymenttype    = $request->paytype;
            $objcustomize->preftime       = $request->ptime;
            $objcustomize->prefdate       = $request->pdate;
            $objcustomize->additional     = $request->additionreq;

            $objcustomize->status         = '1';
            $objcustomize->save(); 

            if (!empty($request->color)) {
              for($i=0;$i<count($request->color);$i++){
                    $objcustomcolor = new Customcolor();
                    $objcustomcolor->custom_id = $objcustomize->id;
                    $objcustomcolor->color_id = $request->color[$i];
                    $objcustomcolor->save();  
                }
           }

           $mail = 'info@dazzleknots.ca';

           $subject = "Custom Dress Design Notification | Dazzleknots";
           Mail::to($mail)->send(new customdesignadminemail($subject)); 

           Session::flash('success', 'your requirement has been submitted  Successfully! Our Team  will contact you soon.');
           return redirect('customdesigning');

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
