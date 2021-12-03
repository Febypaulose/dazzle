<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Usercoupons extends Model
{
     /*table name*/
    protected $table      = 'usercoupons';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'orderid',
  						   'userid',
  						   'couponid',
                           'created_at',
                           'updated_at'
                           ];
}
