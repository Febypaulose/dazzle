<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    /*table name*/
    protected $table      = 'sizes';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'size',
                           'created_at',
                           'updated_at'
                           ];
}
