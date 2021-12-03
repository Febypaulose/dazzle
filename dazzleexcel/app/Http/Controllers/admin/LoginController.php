<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    public function index()
    {
    	return view('admin/login');
    }


    public function validate_credentials(Request $request)
    {
    	$email = $request->username;
    	$password = $request->password;
    	if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password,'usertype' => 'admin'])) {
    		return redirect('manage/dashboard');
    	}else {
             Session::flash('message', 'Username/password is Incorrect!');
           return redirect('manage/');
        }
    }
}
