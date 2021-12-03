<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /*table name*/
    protected $table      = 'products';  

    /*primarykey*/  
  	protected $primaryKey = 'Id';

  	/*table fields*/
  	protected $fillable  = [
  		                   'product_name',
          						   'product_price',
          						   'product_quantity',
                         'current_quantity',
          						   'product_type',
                         'product_tags',
          						   'exchange_rate',
          						   'stock_status',
          						   'description',
          						   'descr_abt_materials',
          						   'summary',
                         'productdesigner',
          						   'product_status',
                         'created_at',
                         'updated_at'
                           ];
                           
    
}
