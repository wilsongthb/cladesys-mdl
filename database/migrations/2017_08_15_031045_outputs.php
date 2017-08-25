<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Outputs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('outputs', function (Blueprint $table) {
            $table->increments('id');
            
            // columnas
            $table->tinyInteger('status');
            $table->tinyInteger('type');// en consts (SALIDA, VENTA, CONVERSION)
            $table->integer('ticket_number')->unsigned();// Se reinicia cada año // id anual
            $table->boolean('flagstate')->default('1');
            
            // para type 2
            $table->string('names', 255)->nullable();
            $table->integer('doc_type')->unsigned()->nullable();// DNI, RUC, en consts mas detalles
            $table->string('doc_number', 20)->nullable();// numero de DNI o RUC
            $table->string('address', 255)->nullable();

            // referencia a tickets
            $table->integer('tickets_id')->unsigned();
            // $table->foreign('tickets_id')->references('id')->on('tickets');

            // referencia a locations // destino
            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations');

            // referencia al usuario
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            // timestamps create_at y update_at
            $table->timestamps();
        });

        Schema::create('output_details', function (Blueprint $table) {
            $table->increments('id');
            
            // columnas
            $table->float('utility', 4, 2); // configuracion de utilidad
            $table->float('unit_price', 11, 2);
            $table->integer('quantity');
            $table->boolean('flagstate')->default('1');

            // referencia a input_details
            $table->integer('input_details_id')->unsigned();
            $table->foreign('input_details_id')->references('id')->on('input_details')->onDelete('cascade');// para evitar errores en outputs

            // referencia a outputs
            $table->integer('outputs_id')->unsigned();
            $table->foreign('outputs_id')->references('id')->on('outputs');

            // referencia al usuario
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            // timestamps create_at y update_at
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
        Schema::dropIfExists('output_details');
        Schema::dropIfExists('outputs');
    }
}
