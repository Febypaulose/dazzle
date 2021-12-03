<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Productcategory extends Model
{
    /*table name*/
    protected $table      = 'productscategories';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'productId',
  						   'categoryId',
  						   'subcategoryId',
                           'created_at',
                           'updated_at'
                           ];
}
