<?php

namespace App\Helpers;

use App\model\Accounts;
/**
 * Canadapost
 */
class Canadapost
{
	/**
 	* Create shipper
 	*/
	public function createshipper()
	{
		 $url = 'https://sandbox-api.postmen.com/v3/shipper-accounts';
	     $method = 'POST';
	     $headers = array(
	        "content-type: application/json",
	        "postmen-api-key: 930ce24d-512d-45b9-92c1-a9dd3311f7dd"
	    );
	    $body = '{"slug":"canada-post","description":"My Shipper Account","timezone":"Asia/Hong_Kong","credentials":{"api_key":"33e095f74df1c6bd","contract_id":"0008963363","customer_number":"3bc8300c0f1f8944ecd485"},"address":{"country":"CAN","contact_name":"Ada","phone":"+16476942677","fax":null,"email":"ada@seller.com","company_name":"Testing Company","street1":"330-340 W 34th St","street2":"Can Ada stop, Canada","city":"Central","type":"residential","postal_code":"T5A 1H1","state":"AB","street3":null,"tax_id":null}}';

	     $curl = curl_init();
	
	    curl_setopt_array($curl, array(
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_URL => $url,
	        CURLOPT_CUSTOMREQUEST => $method,
	        CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $body
	    ));
	
	    $response = curl_exec($curl);
	    $err = curl_error($curl);
	
	    curl_close($curl);
	
	    if ($err) {
	    	echo "cURL Error #:" . $err;
	    } else {
	    	return $response;
	    }
	}

	/**
 	* Add credentials
 	*/
	public function addcredentials($shipperid,$slug)
	{
		$objcreds                     = new Accounts(); 
        $objcreds->shipperid          = $shipperid; 
        $objcreds->slug               = $slug; 
        $objcreds->save(); 
	}


	public function calculaterates($shipperid)
	{
	    $url = 'https://sandbox-api.postmen.com/v3/rates';
	    $method = 'POST';
	    $headers = array(
	        "content-type: application/json",
	        "postmen-api-key: 930ce24d-512d-45b9-92c1-a9dd3311f7dd"
	    );
	    $body = '{"async":false,"shipper_accounts":[{"id":"'.$shipperid.'"}],"is_document":false,"shipment":{"parcels":[{"description":"Food XS","box_type":"custom","weight":{"value":2,"unit":"kg"},"dimension":{"width":20,"height":40,"depth":40,"unit":"cm"},"items":[{"description":"Food Bar","origin_country":"JPN","quantity":2,"price":{"amount":3,"currency":"CAD"},"weight":{"value":0.6,"unit":"kg"},"sku":"PS4-2015"}]}],"ship_from":{"contact_name":"Yin Ting Wong","street1":"Flat A, 29/F, Block 17\nLaguna Verde","city":"Hung Hom","state":"Alberta","postal_code":"T5A1H1","country":"CAN","phone":"+1-613-555-0159","email":"test@test.test","type":"residential"},"ship_to":{"contact_name":"Yin Ting Wong","street1":"Flat A, 29/F, Block 17\nLaguna Verde","city":"Hung Hom","state":"Alberta","postal_code":"T5A1H1","country":"CAN","phone":"+1-613-555-0159","email":"test@test.test","type":"residential"}}}';
	
	    $curl = curl_init();
	
	    curl_setopt_array($curl, array(
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_URL => $url,
	        CURLOPT_CUSTOMREQUEST => $method,
	        CURLOPT_HTTPHEADER => $headers,
			CURLOPT_POSTFIELDS => $body
	    ));
	
	    $response = curl_exec($curl);
	    $err = curl_error($curl);
	
	    curl_close($curl);
	
	    if ($err) {
	    	echo "cURL Error #:" . $err;
	    } else {
	    	echo $response;
	    }
	
	}


	public function getrates($pemfile)
	{
		$username = "33e095f74df1c6bd"; 
		$password = "3bc8300c0f1f8944ecd485";
		$mailedBy = "0008963363";

		// REST URL
		$service_url = 'https://ct.soa-gw.canadapost.ca/rs/ship/price';

		// Create GetRates request xml
		$originPostalCode = 'H2B1A0'; 
		$postalCode = 'K1K4T3';
		$weight = 1;

		$xmlRequest = '<<<XML
		<?xml version="1.0" encoding="UTF-8"?>
		<mailing-scenario xmlns="http://www.canadapost.ca/ws/ship/rate-v4">
		  <customer-number>'.$mailedBy.'</customer-number>
		  <parcel-characteristics>
		    <weight>'.$weight.'</weight>
		  </parcel-characteristics>
		  <origin-postal-code>'.$originPostalCode.'</origin-postal-code>
		  <destination>
		    <domestic>
		      <postal-code>'.$postalCode.'</postal-code>
		    </domestic>
		  </destination>
		</mailing-scenario></XML>';

		$curl = curl_init($service_url); // Create REST Request
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($curl, CURLOPT_CAINFO,$pemfile);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $xmlRequest);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/vnd.cpc.ship.rate-v4+xml', 'Accept: application/vnd.cpc.ship.rate-v4+xml'));
		$curl_response = curl_exec($curl); // Execute REST Request
		if(curl_errno($curl)){
			echo 'Curl error: ' . curl_error($curl) . "\n";
		}

		echo 'HTTP Response Status: ' . curl_getinfo($curl,CURLINFO_HTTP_CODE) . "\n";

		curl_close($curl);
	}
}