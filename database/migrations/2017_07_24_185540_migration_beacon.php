<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationBeacon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Beacon', function (Blueprint $table) {
            $table->increments('id_Beacon');

            $table->string('uuid', 100);
            $table->integer('major')->unsigned();
            $table->integer('minor')->unsigned();
            
            //$table->integer('id_Examen')->nullable()->default(null)->unsigned();
            //$table->foreign('id_Examen')->references('id_Examen')->on('Examen');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*Schema::table('Beacon', function (Blueprint $table) {
            $table->dropForeign('Beacon_id_Examen_foreign');
        });*/
        Schema::drop('Beacon');
    }
}
