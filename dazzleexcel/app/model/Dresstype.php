<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Dresstype extends Model
{
    /*table name*/
    protected $table      = 'dresstype';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'dresstype',
                           'created_at',
                           'updated_at'
                           ];
}
