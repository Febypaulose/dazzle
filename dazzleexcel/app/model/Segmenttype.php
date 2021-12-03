<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Segmenttype extends Model
{
    /*table name*/
    protected $table      = 'segmenttype';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'segmenttype_name',
  						   'segmentslug',
                           'created_at',
                           'updated_at'
                           ];
}
