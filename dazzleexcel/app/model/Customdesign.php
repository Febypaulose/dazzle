<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Customdesign extends Model
{
     /*table name*/
    protected $table      = 'dresscustomize';  

    /*primarykey*/  
  	protected $primaryKey = 'id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'name',
  		                   'mail',
  		                   'phone',
                         'userid',
  		                   'dresstype_id',
  		                   'material_id',
  		                   'handwork',
  		                   'design',
  		                   'paymenttype',
                         'paymentid',
                         'amount',
  		                   'preftime',
  		                   'prefdate',
                         'additional',
  		                   'status',
                           'created_at',
                           'updated_at'
                           ];
   public function dresstypeselect() {
       return $this->belongsTo('App\model\Dresstype', 'dresstype_id');
    }

     public function dressmaterialselect() {
       return $this->belongsTo('App\model\Dressmaterial', 'material_id');
    }
}
