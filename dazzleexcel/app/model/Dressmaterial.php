<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Dressmaterial extends Model
{
     /*table name*/
    protected $table      = 'dressmaterial';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'material',
                           'created_at',
                           'updated_at'
                           ];
}
