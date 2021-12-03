<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Customcolor extends Model
{
     /*table name*/
    protected $table      = 'customizecolor';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'custom_id',
  		                   'color_id',
                           'created_at',
                           'updated_at'
                           ];
}
