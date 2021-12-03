<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
             $table->increments('Id');
             $table->string('product_name');
             $table->integer('product_price');
             $table->integer('product_quantity');
             $table->enum('product_type', ['normal', 'luxury']);
             $table->enum('stock_status', ['in stock', 'Out of stock']);
             $table->text('smalldescr');
             $table->text('description');
             $table->text('descr_abt_materials');
             $table->text('summary');
             $table->text('productdesigner');
             $table->enum('product_status', ['enabled', 'disabled']);
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
