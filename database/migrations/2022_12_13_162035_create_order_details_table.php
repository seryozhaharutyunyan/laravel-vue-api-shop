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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('quantity');
            $table->string('price', 150);
            $table->timestampTz('order_date')->nullable();
            $table->enum('status', ['sent', 'not sent']);
            $table->index('product_id', 'order_detail_product_idx');
            $table->foreign('product_id', 'order_detail_product_fk')->
            on('products')->references('id');

            $table->index('order_id', 'order_detail_order_idx');
            $table->foreign('order_id', 'order_detail_order_fk')->
            on('orders')->references('id');

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
    }
};
