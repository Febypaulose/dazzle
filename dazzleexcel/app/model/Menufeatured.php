<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Menufeatured extends Model
{
    /*table name*/
    protected $table      = 'menufeatured';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'productidid',
                           'catid',
                           'created_at',
                           'updated_at'
                           ];
}
