<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationsConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations_config', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations')->onDelete('cascade');

            // config
            $table->string('module');
            $table->boolean('get')->default(true); // read
            $table->boolean('post')->default(true); // create
            $table->boolean('put')->default(true); // update
            $table->boolean('delete')->default(true); // delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations_config');
    }
}
