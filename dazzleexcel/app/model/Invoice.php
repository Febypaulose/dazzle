<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /*table name*/
    protected $table      = 'invoice';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
                        'orderid',
  		                   'invoiceno',
  						   'customer_email',
  						   'customer_id',
  						   'country_code',
  						   'payment_id',
  						   'currency',
  						   'payment_status',
                 'shipping_amt',
                 'tax',
  						   'price',
  						   'status',
                           'created_at',
                           'updated_at'
                           ];
}
