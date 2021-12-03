<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use PayPal\Api\Payer;

class PaypalController extends Controller
{
    public function getPaymentStatus()
    {
    	echo 'hi';
    }
}
