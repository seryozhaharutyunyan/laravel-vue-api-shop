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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('edge_id')->nullable();

            $table->index('region_id', 'city_region_idx');
            $table->foreign('region_id', 'city_region_fk')->
            on('regions')->references('id');

            $table->index('edge_id', 'city_edge_idx');
            $table->foreign('edge_id', 'city_edge_fk')->
            on('edges')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
};
