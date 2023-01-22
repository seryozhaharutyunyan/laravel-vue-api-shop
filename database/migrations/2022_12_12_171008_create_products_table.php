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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->json('images');
            $table->string('price',150);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description');
            $table->unsignedInteger('quantity');
            $table->timestamps();
            $table->softDeletes();

            $table->index('category_id', 'product_category_idx');
            $table->foreign('category_id', 'product_category_fk')->
            on('categories')->references('id');
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
};
