<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Colours extends Model
{
    /*table name*/
    protected $table      = 'colours';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'color_name',
  						   'color_code',
                           'created_at',
                           'updated_at'
                           ];
}
