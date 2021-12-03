<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdershippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordershipping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shippingtype');
            $table->string('shipmentid');
            $table->string('trackingid');
            $table->string('trackingcode');
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
        Schema::dropIfExists('ordershipping');
    }
}
