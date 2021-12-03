<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Productcolor extends Model
{
     /*table name*/
    protected $table      = 'productscolor';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'productId',
  						   'colorId',
                           'created_at',
                           'updated_at'
                           ];
}
