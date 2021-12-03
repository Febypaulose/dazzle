<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\contactEmail;

use App\model\Pages;
use Session;

class Pagesontroller extends Controller
{
    public function help()
    {
    	$slug = 'help';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }

    public function termscondition()
    {
    	$slug = 'terms-and-conditions';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }


    public function privacypolicy()
    {
    	$slug = 'privacy-policy';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }

    public function returnpolicy()
    {
    	$slug = 'return-policy';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }

    public function deliverypolicy()
    {
    	$slug = 'delivery-policy';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }


    public function about()
    {
    	$slug = 'about-us';
    	$data['help'] =  Pages::where('slug','=',$slug)->first();
    	return view('frontent/cmscontents',$data);
    }



    public function contact()
    {
    	return view('frontent/contact');
    }



    public function contactmail(Request $request)
    {
    	$email_data = array(
                    'name'=>$request->fullname,
                    'mobile'=>$request->mobile,
                    'mail'=>$request->mail,
                    'message'=>$request->message,
                    );
    	  $subject = "Contact Us Enquiry";
    	  $mail = 'rr@gmail.com';
    	 Mail::to($mail)->send(new contactEmail($subject,$email_data));

    	 Session::flash('message', 'Enquiry Send  Successfully!');
        return redirect('contactus');

    }
}
