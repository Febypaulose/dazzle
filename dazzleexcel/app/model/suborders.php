<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class suborders extends Model
{
    /*table name*/
    protected $table      = 'suborders';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'product_id',
  						   'order_id',
  						   'price',
  						   'quantity',
                           'created_at',
                           'updated_at'
                           ];
}
