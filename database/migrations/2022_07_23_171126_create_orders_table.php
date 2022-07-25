<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('shipping_address');
            $table->string('phone');
            $table->string('order_code');
            $table->string('order_status');
            $table->string('order_date');
            $table->string('total');
            $table->string('payment_mode');
            $table->timestamp();
            $table->foreign('customer_id')->references('id')->on('users');
           
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->string('price');
            $table->string('options')->nullable();
            $table->foreign('customer_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
    }
};
