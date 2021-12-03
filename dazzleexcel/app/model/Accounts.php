<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    /*table name*/
    protected $table      = 'shipperaccounts';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'shipperid',
  						   'slug',
                           'created_at',
                           'updated_at'
                           ];
}
