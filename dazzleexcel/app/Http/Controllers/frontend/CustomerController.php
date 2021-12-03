<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\WelcomeEmail;

use App\User;
use Session;

class CustomerController extends Controller
{

    public function login()
    {
        return view('frontent/loginregister');
    }


    public function registercustomer(Request $request)
    {
        $this->validate(request(), [
            'custname' => 'required',
            'custemail' => 'required|email|unique:users',
            'custpass' => 'required'
        ]);

        User::create([
            'name' => $request->custname,
            'email' => $request->custemail,
            'password' => bcrypt($request->custpass),
            'usertype' => 'customer',
        ]);

        $email_data = array(
            'name'=>$request->custname,
            );

        Mail::to($request->custemail)->send(new WelcomeEmail($email_data));  

        Session::flash('message', 'Customer Register successfully,Please check mail to activate account!');
        return redirect('loginregister');
    }


    public function customerlogin(Request $request)
    {
        $email = $request->cemail;
        $password = $request->cpassword;
         $par = session('parameters'); 
         $type = session('type'); 
         $page = session('page');
          $pagetypes = session('pagetype');

       
        if (Auth::attempt(['email' => $email, 'password' => $password,'usertype' => 'customer'])) {
            if (!empty(!empty($par))) {
               $parval     = Crypt::encrypt($par); 

               $data['par'] = $parval;

               $data['type'] = $type;

               $data['page'] = $page;
               
               $data['pagetype'] = $pagetypes;
               
               if(!empty($pagetypes) && $pagetypes== 'productdetail' ) {
                   $url = url($page.'/'.$parval);
               } else {
                   $url = url("customer/".$page.'/'.$parval);
               }

                

               return redirect($url);
            } else if(empty($par) &&  !empty($page)){
                $url = url("customer/".$page); 
                return redirect($url);
            } else {
                return redirect('customer/account');
            }
           
        } else {
             Session::flash('message', 'Username/password is Incorrect!');
             return redirect('loginregister');
        }
    }



    public function account()
    {
       return view('frontent/account');
    }


    public function changepeofileimage(Request $request)
    {
        $loggeduserId = Auth::id();
        $profile = $request->profileimage;
        $filenameWithExt =$profile->getClientOriginalName();
        //Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $profile->getClientOriginalExtension();

        $fileNameToStore = 'customer_'.$loggeduserId.'_'.time().'.'.$extension;
        $path = $profile->storeAs('public/customer',$fileNameToStore);

        $obcusimg                   = User::find($loggeduserId); 
        $obcusimg->profileimage     = $fileNameToStore;
        $obcusimg->save(); 

         Session::flash('message', 'Profile Image Successfully Updated!');
         return redirect('customer/account');
    }


    public function profileupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fname'           => 'required',
            'lname'           => 'required',
            'cemail'          => 'required',
            'cphone'          => 'required',
            'newpass'         => 'required',
        ]);

        if ($validator -> fails()) {
           return back()->withErrors($validator)->withInput();
        } else {
            $loggeduserId = Auth::id();


            $fullname = $request->fname.' '.$request->lname;

            $obcusprofile                   = User::find($loggeduserId); 
            $obcusprofile->name             = $fullname;
            $obcusprofile->email            = $request->cemail;
            $obcusprofile->phone            =$request->cphone;
            if (!empty($request->newpass)) {
                $obcusprofile->password    = bcrypt($request->newpass);
            }
            $obcusprofile->save(); 

            Session::flash('message', 'Profile Successfully Updated!');
            return redirect('customer/account');
        }
    }


    public function questcheckoutpart()
    {
         return view('frontent/questchecklogpart');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('loginregister');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        //
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
