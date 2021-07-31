<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('balance_value')->nullable();
            $table->string('balance_mounth')->nullable();
            $table->integer('balance_year')->nullable();
            $table->double('brevious_balance')->nullable();
            $table->double('final_balance')->nullable();
            $table->bigInteger('id_billing')->unsigned();
            $table->foreign('id_billing')->references('id')->on('billings');

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
        Schema::dropIfExists('balances');
    }
}
