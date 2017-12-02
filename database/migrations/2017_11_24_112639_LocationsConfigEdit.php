<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LocationsConfigEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('locations_config');
        Schema::create('locations_config', function (Blueprint $table) {
        // Schema::table('locations_config', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations')->onDelete('cascade');

            // $table->dropColumn(['module', 'get', 'post', 'put', 'delete']);
            $table->integer('default_stage')->unsigned()->nullable();
            // $table->tinyInteger('default_type_stage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('locations_config', function (Blueprint $table) {
        //     // reexecute LocationsConfig Migration
        // });
        Schema::dropIfExists('locations_config');
    }
}
