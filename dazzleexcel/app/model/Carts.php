<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    /*table name*/
    protected $table      = 'carts';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'UserId',
  						   'productId',
  						   'quantity',
  						   'price',
                           'created_at',
                           'updated_at'
                           ];
}
