<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagosYDeudas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inputs', function (Blueprint $table) {
            $table->boolean('paid_out')->default(false);
        });
        Schema::table('outputs', function (Blueprint $table) {
            $table->boolean('paid_out')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inputs', function (Blueprint $table) {
            $table->dropColumn('paid_out');
        });
        Schema::table('outputs', function (Blueprint $table) {
            $table->dropColumn('paid_out');
        });
    }
}
