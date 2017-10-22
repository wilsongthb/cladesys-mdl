<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LabEnchargedJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::dropIfExists('lab_encharged_job');
        Schema::create('lab_encharged_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('description', 322);
            $table->string('items', 322);
            $table->text('observation');
            $table->dateTime('charge'); // fecha de encargo
            $table->dateTime('deliver'); // fecha de entrega

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('clinic_doctors_id')->unsigned();
            $table->foreign('clinic_doctors_id')->references('id')->on('clinic_doctors');

            $table->integer('clinic_patients_id')->unsigned();
            $table->foreign('clinic_patients_id')->references('id')->on('clinic_patients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_encharged_jobs');
    }
}
