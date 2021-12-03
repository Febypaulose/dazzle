<?php

namespace App\Helpers;

use CraigPaul\Moneris\Moneris;

use App\model\guestcart;
use App\model\Carts;
use App\model\Offers;
use Illuminate\Support\Facades\Auth;

use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
use Carbon\Carbon;

use Session;

use App\Helpers\helpers;
use DB;
/**
 * 
 */
class helpers
{
	public function checkoutpayment($store_id,$api_token,$txnArray)
	{
		$url = 'https://www3.moneris.com';
		$connectTimeOut = 20;
		$clientTimeOut = 30;
		$apiVersion = 'PHP NA - 1.0.16';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $txnArray);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connectTimeOut);
		curl_setopt($ch, CURLOPT_TIMEOUT, $clientTimeOut);
		curl_setopt($ch, CURLOPT_USERAGENT, $apiVersion);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		//curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO_CA_BUNDLE");
		
		$response=curl_exec ($ch);

		dd($response);
		
		curl_close ($ch);
	}

	public function getURL()
	{
		$g=new mpgGlobals();
		$gArray=$g->getGlobals();
	
		//$txnType = $this->getTransactionType();
	
		$hostId = "MONERIS".$this->procCountryCode.$this->testMode."_HOST";
		$fileId = "MONERIS".$this->procCountryCode."_MPI_FILE";
	
		$url =  $gArray['MONERIS_PROTOCOL']."://".
				$gArray[$hostId].":".
				$gArray['MONERIS_PORT'].
				$gArray[$fileId];
	
		//echo "PostURL: " . $url;
	
		return $url;
	}


	public function addguestcart($sessionId)
	{
		$gcart = guestcart::where('sessionid','=',$sessionId)->get(); 
		$loggedinId = Auth::user()->id;
		foreach ($gcart as $cart) {
		 	$productid = $cart->productid;
		 	$qty = $cart->quantity;
		 	$price = $cart->price;
		 	if (!empty($gcart)) {
		 		$objcarts                     = new Carts(); 
                $objcarts->UserId             = $loggedinId; 
                $objcarts->productId          = $productid; 
                $objcarts->quantity           = $qty; 
                $objcarts->price              = $price;
                $objcarts->save(); 
                 guestcart::where('sessionid', $sessionId)->delete();
		 	}
		 	
		 } 
	}


	public static  function getdiscountamt($id,$price)
	{
		$offer = Offers::where('productid','=',$id)->first(); 
		$wholeweb = Offers::where('type','=','wholewebsite')->first(); 
		if(!empty($offer)) {
		 	$percentage = $offer->percentage;
        $discount =$price - ($price* ($percentage/100));   
		}
		
		else {
		$wpercent = $wholeweb->percentage;
			$discount =$price - ($price* ($wpercent/100));
		}

	

		//return '$'.$discount;


		$helpers = new helpers();
		$conversion = $helpers->currency_conversion($discount); 

		return $conversion;
	}



	public function discountprice($id,$price)
	{
		$offer = Offers::where('productid','=',$id)->first(); 
		$wholeweb = Offers::where('type','=','wholewebsite')->first(); 
		if (!empty($offer)) {
			$opercent = $offer->percentage;
			$discount = $price * $opercent/100;
		} else if(!empty($wholeweb)){
			$wpercent = $wholeweb->percentage;
			$discount = $price * $wpercent/100;
		}

		$helpers = new helpers();
		$conversion = $helpers->currency_conversion($discount); 

		return $conversion;




	}


	public static  function getaverage($revenue)
	{
		$average = $revenue /365;

		return number_format((float)$average, 2, '.', '');
	}


public static function currency_conversions($price)
	{
	    // set API Endpoint, access key, required parameters
$endpoint = 'convert';
$access_key = '3e6beee7ebe8ecab1717e641cfe044ee';
	$basecurr = env('BASE_CURR');
	$currency = Session::get('currency');
	
		if (empty($currency)) {
		 	$currcode = $basecurr;
		 } else {
		 	$currcode = Session::get('currency');
		 }
 $from = $basecurr;
 $to = strtoupper($currcode);
  $amount = $price + 0.1 ;
   gettype($amount);
// initialize CURL:
$ch = curl_init('https://api.exchangeratesapi.io/v1/convert?access_key=3e6beee7ebe8ecab1717e641cfe044ee&from='.$from.'&to='.$to.'&amount='.$amount.'');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// get the JSON data:
$json = curl_exec($ch);
curl_close($ch);

// Decode JSON response:
$conversionResult = json_decode($json, true);

// access the conversion result
  $conversionResult['result'];


		 if (!empty($currency)) {
		 	$exchangerate = round($conversionResult['result'], 0);
		 $format = number_format((float)$exchangerate, 2, '.', '');
		 	$formatsplit = explode('.00', $format);
		 	return $formatsplit[0];
		 } else {
		 	$exchangerate = round($conversionResult['result'], 0);
		 		$format = number_format((float)$exchangerate, 2, '.', '');
		 	$formatsplit = explode('.00', $format);
		    return $exchangerate;
		 }


		 
	}

	public static function currency_conversion($price)
	{
			$basecurr = env('BASE_CURR');
	$currency = Session::get('currency');
	
		if (empty($currency)) {
		 	$currcode = $basecurr;
		 } else {
		 	$currcode = Session::get('currency');
		 }

	 $convertedprice = DB::table('curreny_conversions')->first();
	 if (!empty($currency)) {
	 if(Session::get('currency')=='cad')	 {
$exchangerate = $exchangerate= round( $price, 0);
   return $currcode.' '.$exchangerate;
// 		 		$format = number_format((float)$exchangerate, 2, '.', '');
// 		 	$formatsplit = explode('.00', $format);
// 		    return $currcode.' '.$exchangerate;

	 }
	 if(Session::get('currency')=='usd')	 {

 $prices=  $convertedprice->usd*$price;
                            $exchangerate= round( $prices, 0);
                             return strtoupper($currcode).' '.$exchangerate;
	 }
	}

	if(empty($currency)){

		$exchangerate =$price;
   return $currcode.' '.$exchangerate;
	}
// set API Endpoint, access key, required parameters
// $endpoint = 'convert';
// $access_key = '3e6beee7ebe8ecab1717e641cfe044ee';
// 	$basecurr = env('BASE_CURR');
// 	$currency = Session::get('currency');
	
// 		if (empty($currency)) {
// 		 	$currcode = $basecurr;
// 		 } else {
// 		 	$currcode = Session::get('currency');
// 		 }
//  $from = $basecurr;
//  $to = strtoupper($currcode);
//   $amount = $price + 0.1 ;
//    gettype($amount);
// // initialize CURL:
// $ch = curl_init('https://api.exchangeratesapi.io/v1/convert?access_key=3e6beee7ebe8ecab1717e641cfe044ee&from='.$from.'&to='.$to.'&amount='.$amount.'');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// // get the JSON data:
// $json = curl_exec($ch);
// curl_close($ch);

// // Decode JSON response:
// $conversionResult = json_decode($json, true);

// // access the conversion result
//   $conversionResult['result'];


// 		 if (!empty($currency)) {
// 		 	$exchangerate = round($conversionResult['result'], 0);
// 		 $format = number_format((float)$exchangerate, 2, '.', '');
// 		 	$formatsplit = explode('.00', $format);
// 		 	return strtoupper($currcode).' '.$formatsplit[0];
// 		 } else {
// 		 	$exchangerate = round($conversionResult['result'], 0);
// 		 		$format = number_format((float)$exchangerate, 2, '.', '');
// 		 	$formatsplit = explode('.00', $format);
// 		    return $currcode.' '.$exchangerate;
// 		 }
// 		$exchangeRates = new ExchangeRate();
// 		//$available = $exchangeRates->currencies(); 
// 		$basecurr = env('BASE_CURR');
// 		$currency = Session::get('currency');
// 		if (empty($currency)) {
// 		 	$currcode = $basecurr;
// 		 } else {
// 		 	$currcode = Session::get('currency');
// 		 }
//   $data= number_format((float)$price, 2, '.', '');

// 		 $exchange = $exchangeRates->convert(number_format((float)$price, 1, '.', ''), $basecurr, strtoupper($currcode), Carbon::now()); 


// 		 if (!empty($currency)) {
// 		 	$exchangerate = round($exchange, 0);
// 		 	$format = number_format((float)$exchangerate, 2, '.', '');
// 		 	$formatsplit = explode('.00', $format);
// 		 	return strtoupper($currcode).' '.$exchangerate;
// 		 } else {
// 		 	$exchangerate = round($exchange, 0);
// 		 		$format = number_format((float)$exchangerate, 2, '.', '');
// 		 	$formatsplit = explode('.00', $format);
// 		    return $currcode.' '.$exchangerate;
// 		 }

		 
	}


	public static function currency_payment($price)
	{

		$exchangeRates = new ExchangeRate();
		//$available = $exchangeRates->currencies(); 
		$basecurr = env('BASE_CURR');
		$currency = Session::get('currency');
		if (empty($currency)) {
		 	$currcode = $basecurr;
		 } else {
		 	$currcode = Session::get('currency');
		 }


		 $exchange = $exchangeRates->convert($price, $basecurr, strtoupper($currcode), Carbon::now()); 


		 if (!empty($currency)) {
		 	$format = number_format((float)$exchange, 2, '.', '');
		 	return $format;
		 } else {
		 	return $exchange.'.00';
		 }

		 
	}


}