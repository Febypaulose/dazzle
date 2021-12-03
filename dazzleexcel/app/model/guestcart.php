<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class guestcart extends Model
{
    /*table name*/
    protected $table      = 'quest_cart';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'sessionid',
  		                   'productid',
  		                   'quantity',
  		                   'price',
                           'created_at',
                           'updated_at'
                           ];
}
