<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->double('amount');
            $table->string('verification');
            $table->string('toPayBy');
            $table->bigInteger('id_provider')->unsigned();
            $table->foreign('id_provider')->references('id')->on('users');
            $table->bigInteger('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects');
            $table->string('status')->default('waiting');
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
        Schema::dropIfExists('expenses');
    }
}
