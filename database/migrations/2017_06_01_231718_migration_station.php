<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationStation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Station', function (Blueprint $table) {
            $table->increments('id_Station');
            $table->integer('ponderation');

            $table->integer('id_Banque')->unsigned();
            $table->foreign('id_Banque')->references('id_Banque')->on('Banque');

            $table->integer('id_Examen')->unsigned();
            $table->foreign('id_Examen')->references('id_Examen')->on('Examen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Station', function (Blueprint $table) {
            $table->dropForeign('Station_id_Banque_foreign');
            $table->dropForeign('Station_id_Examen_foreign');
        });
        Schema::drop('Station');
    }
}
