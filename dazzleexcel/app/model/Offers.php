<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
     /*table name*/
    protected $table      = 'offers';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                     'type',
                           'parentid',
                           'categoryid',
                           'subcategoryid',
                           'productid',
                           'percentage',
                           'created_at',
                           'updated_at'
                           ];
}
