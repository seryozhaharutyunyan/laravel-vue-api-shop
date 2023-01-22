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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->text('comment');
            $table->timestamps();

            $table->index('user_id', 'comment_user_idx');
            $table->foreign('user_id', 'comment_user_fk')->
            on('users')->references('id');

            $table->index('product_id', 'comment_product_idx');
            $table->foreign('product_id', 'comment_product_fk')->
            on('products')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
