<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /*table name*/
    protected $table      = 'countries';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'country_code',
  						   'country_name',
                           'created_at',
                           'updated_at'
                           ];
}
