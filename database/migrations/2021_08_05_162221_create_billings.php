<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillings extends Migration
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
            $table->string('billing_month')->nullable();
            $table->integer('billing_year')->nullable();
            $table->text('penalties')->nullable();
            $table->double('nbrOfDaysWorked')->nullable();
            $table->double('bill_amount')->default(0);
            $table->double('total_commissions')->default(0);
            $table->double('balance')->default(0);
            $table->double('total_expenses')->default(0);
            $table->double('net_bill_after_comiss')->default(0);
            $table->double('total_amount')->default(0);
            $table->string('status')->default('unpaid');
            $table->double('all_total_bill')->default(0);
            $table->double('all_total_paid')->default(0);
            $table->double('all_total_paid_per_client')->default(0);
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
