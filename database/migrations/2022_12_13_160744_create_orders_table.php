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
            $table->string('price', 150);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->text('address');

            $table->index('user_id', 'order_user_idx');
            $table->foreign('user_id', 'order_user_fk')->
            on('users')->references('id');

            $table->index('city_id', 'order_city_idx');
            $table->foreign('city_id', 'order_city_fk')->
            on('cities')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
