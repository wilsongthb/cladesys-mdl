<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relationals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');            
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('name');
            $table->string('code', '128');
            $table->string('image_path')->nullable();
            $table->tinyInteger('level')->default('1');
            $table->integer('units')->default('1');
            $table->integer('brands_id')->unsigned();
            $table->foreign('brands_id')->references('id')->on('brands');
            $table->integer('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories');
            $table->integer('packings_id')->unsigned();
            $table->foreign('packings_id')->references('id')->on('packings');
            $table->integer('measurements_id')->unsigned();
            $table->foreign('measurements_id')->references('id')->on('measurements');
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');            
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->string('contact_name');
            $table->string('phone');
            $table->string('country')->default('');
            $table->string('region');
            $table->string('account_number');
            $table->string('bank', 150);
            // no requerido
            $table->string('company_name')->nullable();
            $table->tinyInteger('doc_type')->nullable(); // usando el de config
            $table->string('identity', 18)->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('home_page')->nullable(); // url
            $table->string('email')->nullable();
            $table->string('observation')->nullable();
            $table->string('products_stock')->nullable(); // en json
            
        });

        Schema::create('inputs', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');            
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations');
            // no requerido
            // $table->string('observation', 500)->nullable();
            $table->text('observation')->nullable();
            $table->tinyInteger('type')->nullable()->default('1');  // en caso sea 2, esta relacionado con outputs_id
            $table->integer('outputs_id')->unsigned()->nullable(); // para evitar referencias cruzadas XD
            // $table->foreign('outputs_id')->references('id')->on('outputs')->onDelete('cascade');
            $table->tinyInteger('status')->default('1');
        });

        Schema::create('input_details', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');            
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->float('unit_price', 20, 2);
            $table->integer('quantity');
            $table->date('expiration')->nullable();
            $table->string('ticket_number', '128')->nullable();
            $table->tinyInteger('ticket_type')->nullable();
            $table->integer('suppliers_id')->unsigned()->nullable();
            $table->foreign('suppliers_id')->references('id')->on('suppliers');
            $table->integer('inputs_id')->unsigned();
            $table->foreign('inputs_id')->references('id')->on('inputs')->onDelete('cascade');
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
            //no requerido
            $table->date('fabrication')->nullable();
            $table->string('lot', 20)->nullable();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->date('shipping'); // fecha de envio
            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations');
            // no requerido
            $table->char('status', 1)->default('1'); // estado del envio
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flagstate')->default('1');
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('quantity');
            $table->string('detail')->nullable();
            $table->integer('orders_id')->unsigned();
            $table->foreign('orders_id')->references('id')->on('orders');
            $table->integer('products_id')->unsigned()->nullable();
            $table->foreign('products_id')->references('id')->on('products');
        });

        
        Schema::create('product_options', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();// creador - ultimo editor
            $table->foreign('user_id')->references('id')->on('users');
            
            // tabla de relacion n a m de products y locations
            // STOCK
            $table->integer('minimum');
            $table->integer('permanent');
            // DURACION
            $table->integer('duration')->unsigned();// en dias
            // RELACIONES
            $table->integer('products_id')->unsigned();
            $table->foreign('products_id')->references('id')->on('products');
            $table->integer('locations_id')->unsigned();
            $table->foreign('locations_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_options');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        
        Schema::dropIfExists('input_details');
        Schema::dropIfExists('inputs');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('products');
    }
}
