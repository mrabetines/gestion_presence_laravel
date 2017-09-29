<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationBeaconExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Beacon_Examen', function (Blueprint $table) {
            $table->increments('id_Beacon_Examen');

            $table->integer('id_Beacon')->unsigned();
            $table->foreign('id_Beacon')->references('id_Beacon')->on('Beacon');

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
        Schema::table('Beacon_Examen', function (Blueprint $table) {
            $table->dropForeign('Beacon_Examen_id_Beacon_foreign');
            $table->dropForeign('Beacon_Examen_id_Examen_foreign');
        });
        Schema::drop('Beacon_Examen');
    }
}
