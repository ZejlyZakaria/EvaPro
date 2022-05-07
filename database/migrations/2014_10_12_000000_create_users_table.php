<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->string('address')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('type')->nullable();
            $table->string('social_security_number')->nullable();
            $table->string('image')->default('avatar.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->integer('project_count')->default(0);
            $table->boolean('isFirstTime')->default(true);
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
