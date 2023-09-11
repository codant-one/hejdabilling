<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Countries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('iso')->nullable();
            $table->string('name');
            $table->string('nicename')->nullable();
            $table->string('iso3')->nullable();
            $table->integer('numcode')->nullable();
            $table->string('phonecode')->nullable();
            $table->unsignedSmallInteger('phone_digits')->default(0)->comment('Maximum number of phone digits');
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
