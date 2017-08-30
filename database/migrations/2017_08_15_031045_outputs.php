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
            $table->boolean('flagstate')->default('1');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            
            // columnas
            $table->tinyInteger('status')->default('1');
            $table->tinyInteger('type');// en consts (SALIDA, VENTA, CONVERSION)
            $table->integer('ticket_number')->unsigned()->nullable();// Se reinicia cada año // id anual
            $table->integer('ticket_type')->unsigned()->nullable();
            // para type 3
            $table->string('names', 255)->nullable();
            $table->integer('doc_type')->unsigned()->nullable();// DNI, RUC, en consts mas detalles
            $table->string('doc_number', 20)->nullable();// numero de DNI o RUC
            $table->string('address', 255)->nullable();
            $table->text('observation')->nullable();

            // referencia a locations // destino
            $table->integer('locations_id')->unsigned(); // ORIGEN
            $table->foreign('locations_id')->references('id')->on('locations');
            $table->integer('target_locations_id')->unsigned()->nullable(); // DESTINO // type 2
            $table->foreign('target_locations_id')->references('id')->on('locations');

            // referencia al usuario

            // timestamps create_at y update_at
            $table->timestamps();
        });

        Schema::create('output_details', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            
            // columnas
            $table->float('utility', 4, 2); // configuracion de utilidad
            $table->float('unit_price', 20, 2);
            $table->integer('quantity');


            // referencia a input_details
            $table->integer('input_details_id')->unsigned();
            $table->foreign('input_details_id')->references('id')
                ->on('input_details')
                ->onDelete('cascade');
                // para evitar errores en outputs

            // referencia a outputs
            $table->integer('outputs_id')->unsigned();
            $table->foreign('outputs_id')->references('id')
                ->on('outputs')
                ->onDelete('cascade');

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
