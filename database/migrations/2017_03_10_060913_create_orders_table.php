<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('invoice_number');
            $table->enum('fare_type', ['cash', 'paypal']);
            $table->string('shipping_address');
            $table->longText('message');
            $table->date('delivery_start');
            $table->date('delivery_end');
            $table->enum('delivery_status', ['waiting', 'delivering', 'completed']);
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
        Schema::drop('orders');
    }
}
