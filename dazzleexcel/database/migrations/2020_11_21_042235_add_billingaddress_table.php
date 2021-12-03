<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBillingaddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billingaddress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('orderid');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('mail');
            $table->string('phone');
            $table->integer('countryid');
            $table->string('address1');
            $table->string('address2');
            $table->string('city');
            $table->string('pocode');
            $table->string('notes');
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
        Schema::dropIfExists('billingaddress');
    }
}
