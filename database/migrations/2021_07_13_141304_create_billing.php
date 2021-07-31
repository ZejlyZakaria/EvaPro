<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBilling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billing_mounth')->nullable();
            $table->integer('billing_year')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->double('daily_rate')->nullable();
            $table->text('penalties')->nullable();
            $table->double('bill_amount')->nullable();
            $table->double('commission')->nullable();
            $table->double('net_bill_after_comiss')->nullable();
            $table->double('mission_expenses')->nullable();
            $table->double('total_amount')->nullable();
            $table->boolean('bill_paid')->nullable();
            $table->double('all_total_bill')->nullable();
            $table->double('all_total_paid')->nullable();
            $table->double('all_total_commission')->nullable();
            $table->bigInteger('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects');
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
        Schema::dropIfExists('billings');
    }
}
