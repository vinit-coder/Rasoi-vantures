<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('shipping_id');
            $table->string('shipping_email');
            $table->string('shipping_first_name');
            $table->string('shipping_last_name');
             $table->string('shipping_mobile_number')->nullable();
            $table->string('shipping_address');
            $table->string('shipping_city');
            $table->string('shipping');
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
        Schema::dropIfExists('shippings');
    }
}
