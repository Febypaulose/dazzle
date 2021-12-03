<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
     /*table name*/
    protected $table      = 'notification';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                     'type',
                           'notification_text',
                           'created_at',
                           'updated_at'
                           ];
}
