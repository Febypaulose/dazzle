<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    /*table name*/
    protected $table      = 'testimonials';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'userid',
  						   'image',
  						   'message',
  						   'status',
                           'created_at',
                           'updated_at'
                           ];
}
