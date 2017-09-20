<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alerts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->string('title');
            $table->string('message', 800);
            $table->tinyInteger('type')->default(1);
            $table->integer('user_id')->unsigned()->nullable(); // autor
            $table->integer('user_id_target')->unsigned()->nullable(); // para
            $table->boolean('viewed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alerts');
    }
}
