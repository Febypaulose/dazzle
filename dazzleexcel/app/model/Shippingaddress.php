<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Shippingaddress extends Model
{
     /*table name*/
    protected $table      = 'shippingaddress';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'orderid',
  						   'first_name',
  						   'last_name',
  						   'mail',
  						   'phone',
  						   'countryid',
  						   'address1',
  						   'address2',
  						   'city',
  						   'pocode',
                           'created_at',
                           'updated_at'
                           ];
}
