<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrecision extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_details', function (Blueprint $table) {
            $table->decimal('unit_price', 20, 3)->change();
        });
        Schema::table('output_details', function (Blueprint $table) {
            $table->decimal('unit_price', 20, 3)->change();
            $table->decimal('real_unit_price', 20, 3)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('input_details', function (Blueprint $table) {
            $table->decimal('unit_price', 20, 2)->change();
        });
        Schema::table('output_details', function (Blueprint $table) {
            $table->decimal('unit_price', 20, 2)->change();
            $table->decimal('real_unit_price', 20, 2)->change();
        });
    }
}
