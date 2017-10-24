<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InstrumentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrument_history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('flagstate')->default(true);

            $table->integer('clinic_doctors_id')->unsigned();
            $table->foreign('clinic_doctors_id')->references('id')->on('clinic_doctors');
            $table->integer('clinic_doctors_id_collector')->unsigned()->nullable();
            $table->foreign('clinic_doctors_id_collector')->references('id')->on('clinic_doctors');
            $table->integer('clinic_patients_id')->unsigned()->nullable();
            $table->foreign('clinic_patients_id')->references('id')->on('clinic_patients');
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');

            $table->date('charge')->nullable();
            $table->date('deliver')->nullable();
            $table->string('observation')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('quantity')->default(1);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instrument_history');
    }
}
