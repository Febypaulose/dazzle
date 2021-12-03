<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /*table name*/
    protected $table      = 'currencies';  

    /*primarykey*/  
  	protected $primaryKey = 'Id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'name',
  						   'code',
  						   'format',
  						   'symbol',
  						   'exchange_rate',
  						   'active',
                           'created_at',
                           'updated_at'
                           ];
}
