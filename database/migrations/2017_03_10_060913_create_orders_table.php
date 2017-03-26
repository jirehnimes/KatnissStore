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
            $table->string('invoice_number');
            $table->enum('fare_type', ['cash', 'paypal']);
            $table->decimal('amount', 11, 2);
            $table->string('shipping_address');
            $table->longText('message');
            $table->string('paypal_id');
            $table->string('paypal_info');
            $table->integer('paid')->default(0);
            $table->date('delivery_start')->default('0000-00-00 00:00:00');
            $table->date('delivery_end')->default('0000-00-00 00:00:00');
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
