<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
     /*table name*/
    protected $table      = 'pages';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'title',
  						   'slug',
  						   'content',
                           'created_at',
                           'updated_at'
                           ];
}
