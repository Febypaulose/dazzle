<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    /*table name*/
    protected $table      = 'subscription';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'email',
                           'created_at',
                           'updated_at'
                           ];
}
