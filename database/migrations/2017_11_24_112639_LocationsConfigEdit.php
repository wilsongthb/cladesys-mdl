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
        Schema::table('locations_config', function (Blueprint $table) {
            $table->dropColumn(['module', 'get', 'post', 'put', 'delete']);
            $table->integer('default_stage')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations_config', function (Blueprint $table) {
            // reexecute LocationsConfig Migration
        });
    }
}
