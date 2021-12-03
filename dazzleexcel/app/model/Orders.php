<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /*table name*/
    protected $table      = 'orders';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'user_id',
                         'orderno',
  						           'invoice_id',
                         'paymenttype',
                         'shippingtype',
  						           'status',
                         'created_at',
                         'updated_at'
                           ];
     public function invoiceselect() {
       return $this->belongsTo('App\model\Invoice', 'id');
    }

     public function userselect() {
       return $this->belongsTo('App\User', 'user_id');
    }
}
