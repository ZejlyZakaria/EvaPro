<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('global_cost_value')->nullable();
            $table->double('total_payment')->nullable();
            $table->string('payment_mounth')->nullable();
            $table->integer('payment_year')->nullable();
            $table->bigInteger('id_provider')->unsigned();
            $table->foreign('id_provider')->references('id')->on('users');
            $table->bigInteger('id_billing')->unsigned();
            $table->foreign('id_billing')->references('id')->on('billings');
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
        Schema::dropIfExists('payments');
    }
}
