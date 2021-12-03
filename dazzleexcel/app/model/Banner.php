<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
   /*table name*/
    protected $table      = 'banners';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'title',
  						   'description',
  						   'image',
  						   'position',
  						   'url',
                           'created_at',
                           'updated_at'
                           ];
}
