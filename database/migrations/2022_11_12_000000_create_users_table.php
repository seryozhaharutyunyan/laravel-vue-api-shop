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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',45);
            $table->string('last_name',45);
            $table->string('email')->unique();
            $table->string('pone',16)->unique();
            $table->string('gender',10);
            $table->timestamp('age');
            $table->text('img');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('city_id');
            $table->text('address');
            $table->string('password');
            $table->boolean('block')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->index('role_id', 'user_role_idx');
            $table->foreign('role_id', 'user_role_fk')->
            on('roles')->references('id');

            $table->index('city_id', 'user_city_idx');
            $table->foreign('city_id', 'user_city_fk')->
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
        Schema::dropIfExists('users');
    }
};
