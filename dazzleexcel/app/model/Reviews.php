<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
     /*table name*/
    protected $table      = 'reviews';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'userid',
  						   'productid',
  						   'name',
  						   'summary',
  						   'rating',
                           'created_at',
                           'updated_at'
                           ];
}
