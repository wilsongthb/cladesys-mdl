<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Basics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
            Tablas para guardar clave valor, normalizacion
        */

        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->string('value');
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->string('value');
        });
        Schema::create('packings', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->string('value');
        });
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->string('value');
        });
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();

            $table->tinyInteger('type');// 1: almacen, 2: sucursal, 3: otros
            $table->string('name'); // nombre del almacen o localizacion
            $table->float('utility', 3, 2);// rango de -999% o  0% a 100% o 999%
            // responsable principal - creador
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // normalizacion
        Schema::dropIfExists('brands'); 
        Schema::dropIfExists('categories');
        Schema::dropIfExists('packings');
        Schema::dropIfExists('measurements');
        // registro
        Schema::dropIfExists('locations');
    }
}
