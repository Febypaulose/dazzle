<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Productsize extends Model
{
     /*table name*/
    protected $table      = 'productsize';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'productId',
  						           'sizeId',
                           'created_at',
                           'updated_at'
                           ];
}
