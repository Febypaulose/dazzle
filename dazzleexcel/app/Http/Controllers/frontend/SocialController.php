<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\User;

class SocialController extends Controller
{
    /**
    * Handle Social login request
    *
    * @return response
    */
    public function socialLogin($social)
    {
    	return Socialite::driver($social)->redirect();
    }


    /**
    * Obtain the user information from Social Logged in.
    * @param $social
    * @return Response
    */
    public function handleProviderCallback($social)
    {
    	$userSocial = Socialite::driver($social)->user(); 
    	$user = User::where(['email' => $userSocial->getEmail()])->first(); 
    	$par = session('parameters'); 
        $type = session('type'); 
        $page = session('page'); 
    	
    	if($user){
    	    Auth::login($user);
    	    if (!empty(!empty($par))) {
               $parval     = Crypt::encrypt($par); 

               $data['par'] = $parval;

               $data['type'] = $type;

               $data['page'] = $page;

               $url = url("customer/".$page.'/'.$parval); 

               return redirect($url);
            } else if(empty($par) &&  !empty($page)){
                $url = url("customer/".$page); 
                return redirect($url);
            } else {
                return redirect('customer/account');
            }
    	} else {
    	   // $userdetail = User::create([
        //     'name' => $userSocial->name,
        //     'email' => $userSocial->name,
        //     'usertype' => 'customer',
        //   ]);
          $userdetail = new User();
          $userdetail->name = $userSocial->name;
          $userdetail->email = $userSocial->email ;
          $userdetail->usertype = 'customer';
          $userdetail->save();
          
          $user = User::where(['id' => $userdetail->id])->first();
          Auth::login($user);
    	  if (!empty(!empty($par))) {
               $parval     = Crypt::encrypt($par); 

               $data['par'] = $parval;

               $data['type'] = $type;

               $data['page'] = $page;

               $url = url("customer/".$page.'/'.$parval); 

               return redirect($url);
            } else if(empty($par) &&  !empty($page)){
                $url = url("customer/".$page); 
                return redirect($url);
            } else {
                return redirect('customer/account');
            }
    	}
    	
    }

}
