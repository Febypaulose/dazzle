<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    /*table name*/
    protected $table      = 'address';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'userid',
                         'title',
  						   'address1',
  						   'address2',
  						   'towncity',
  						   'countryid',
  						   'zipcode',
                 'default_address',
                           'created_at',
                           'updated_at'
                           ];
}
