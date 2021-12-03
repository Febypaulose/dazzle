<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class guestwishlist extends Model
{
     /*table name*/
    protected $table      = 'quest_wishlist';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'userid',
  		                   'productid',
                           'created_at',
                           'updated_at'
                           ];
}
