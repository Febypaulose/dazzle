<?php

namespace App\Helpers;

/**
 * Shipping
 */
class Shipping 
{






	// soap
	public function getallrates()
	{

	 $url = 'https://sandbox-api.postmen.com/v3/rates';
	    $method = 'POST';
	    $headers = array(
	        "content-type: application/json",
	        "postmen-api-key: 930ce24d-512d-45b9-92c1-a9dd3311f7dd"
	    );
	    $body = '{"async":false,"shipper_accounts":[{"id":"00000000-0000-0000-0000-000000000000"}],"is_document":false,"shipment":{"ship_from":{"contact_name":"Elmira Zulauf","company_name":"Kemmer-Gerhold","street1":"662 Flatley Manors","country":"HKG","type":"business"},"ship_to":{"contact_name":"Dr. Moises Corwin","phone":"1-140-225-6410","email":"Giovanna42@yahoo.com","street1":"28292 Daugherty Orchard","city":"Beverly Hills","postal_code":"90209","state":"CA","country":"USA","type":"residential"},"parcels":[{"description":"Food XS","box_type":"custom","weight":{"value":2,"unit":"kg"},"dimension":{"width":20,"height":40,"depth":40,"unit":"cm"},"items":[{"description":"Food Bar","origin_country":"USA","quantity":2,"price":{"amount":3,"currency":"USD"},"weight":{"value":0.6,"unit":"kg"},"sku":"imac2014"}]}]}}';
	
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

}
	
