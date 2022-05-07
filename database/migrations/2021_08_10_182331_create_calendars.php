<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('start');
            $table->date('end')->nullable();
            $table->double('nbrOfDays')->default(0);
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
        Schema::dropIfExists('calendars');
    }
}
