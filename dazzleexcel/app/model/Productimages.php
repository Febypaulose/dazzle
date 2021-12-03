<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Productimages extends Model
{
    /*table name*/
    protected $table      = 'productsimages';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'productId',
  						   'image_url',
  						   'subcategoryId',
  						   'title',
  						   'description',
                           'created_at',
                           'updated_at'
                           ];
}
