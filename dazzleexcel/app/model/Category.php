<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*table name*/
    protected $table      = 'category';  

    /*primarykey*/  
  	protected $primaryKey = 'Id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'parentId',
  						   'category',
                           'created_at',
                           'updated_at'
                           ];
}
