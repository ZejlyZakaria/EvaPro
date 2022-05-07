<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalances extends Migration
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
            $table->double('balance_value')->default(0);
            $table->string('balance_mounth')->nullable();
            $table->integer('balance_year')->nullable();
            $table->bigInteger('brevious_balance')->unsigned();
            $table->double('final_balance')->default(0);
            $table->bigInteger('id_billing')->unsigned();
            $table->foreign('id_billing')->references('id')->on('billings');
            $table->foreign('brevious_balance')->references('id')->on('balances');

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
