<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('nick');
            $table->string('avatar')->nullable();
            $table->string('company')->nullable();
            $table->string('country_company')->nullable();
            $table->string('address_company')->nullable();
            $table->string('phone_company')->nullable();
            $table->string('logo_company')->nullable();
            $table->string('color_company')->nullable();
            $table->string('password');
            $table->longText('token_2fa')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
