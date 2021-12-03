<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Billingdetails extends Model
{
    /*table name*/
    protected $table      = 'billingaddress';  

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
  						   'notes',
                           'created_at',
                           'updated_at'
                           ];
}
