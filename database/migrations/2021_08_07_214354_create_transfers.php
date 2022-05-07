<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('value');
            $table->string('month');
            $table->integer('year');
            $table->bigInteger('id_payment')->unsigned();
            $table->foreign('id_payment')->references('id')->on('payments');
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
        Schema::dropIfExists('transfers');
    }
}
