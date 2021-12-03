<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Session;

class CurrencywitcherController extends Controller
{
    public function currencyswitch(Request $request)
    {
    	$curr = $request->currency; 
    	Session::put('currency',$curr);
    	return redirect()->back();
    }
}
