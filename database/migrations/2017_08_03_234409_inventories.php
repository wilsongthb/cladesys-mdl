<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Inventories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('flagstate')->default('1');

            $table->string('name');
            $table->string('detail', 300);
            $table->string('model');
            $table->tinyInteger('type');
            $table->float('in_price', 8, 2);
            $table->tinyInteger('status')->default(1);
            $table->float('depressiation', 3, 2);
            $table->text('observation');

            // relations
            $table->integer('brands_id')->unsigned();
            $table->foreign('brands_id')->references('id')->on('brands');
            // codigo del estado
            $table->char('prefix', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
