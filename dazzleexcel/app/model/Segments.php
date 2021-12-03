<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Segments extends Model
{
        /*table name*/
    protected $table      = 'segments';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'segmenttypeId',
  						   'productId',
                           'created_at',
                           'updated_at'
                           ];
}
