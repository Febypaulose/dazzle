<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Ordershipping extends Model
{
    /*table name*/
    protected $table      = 'ordershipping';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'orderid',
  		                   'shippingtype',
  						   'shipmentid',
  						   'trackingid',
  						   'trackingcode',
                 'tracking_url',
                           'created_at',
                           'updated_at'
                           ];
}
