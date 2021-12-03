<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    /*table name*/
    protected $table      = 'coupons';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'code',
  						   'type',
  						   'value',
  						   'percent_off',
  						   'from',
  						   'to',
                           'created_at',
                           'updated_at'
                           ];
}
