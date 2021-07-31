<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client');
            $table->string('name');
            $table->double('average_daily_rate');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('outstanding');
            $table->double('commission');
            $table->double('total_commission');
            $table->bigInteger('id_provider')->unsigned();
            $table->foreign('id_provider')->references('id')->on('users');
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
        Schema::dropIfExists('projects');
    }
}
