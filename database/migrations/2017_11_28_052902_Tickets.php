<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tickets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            // $table->integer('number')->autoIncrement();
            $table->json('company')->nullable();
            $table->string('sender');
            $table->integer('number')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('IDCARD')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->string('referral_guide')->nullable();
            $table->string('observation', 300)->nullable();

            $table->decimal('amount', 10, 3)->nullable();// importe
            $table->decimal('paid_out', 10, 3)->nullable();// pagado
            $table->boolean('cancelled')->default(false);

            // relation with other file
            $table->string('table_foreign_name')->nullable();
            $table->integer('table_foreign_id')->nullable();
            
        });

        // create details ticket
        Schema::create('ticket_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('quantity')->default(0);
            $table->string('description');
            $table->decimal('unit_price', 10, 3)->default(0);
            $table->decimal('real_unit_price', 10, 3)->default(0);
            $table->decimal('utility', 10, 3)->default(0);

            $table->integer('tickets_id')->unsigned();
            $table->foreign('tickets_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_details');
        Schema::dropIfExists('tickets');
    }
}
