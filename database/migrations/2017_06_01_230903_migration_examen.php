<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Examen', function (Blueprint $table) {
            $table->increments('id_Examen');
            $table->dateTime('date', 100);
            $table->integer('max_Places');
            $table->integer('nbre_Places');

            $table->integer('id_Session')->unsigned();
            $table->foreign('id_Session')->references('id_Session')->on('Session');


            $table->integer('id_Enseignant')->unsigned()->nullable();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Examen', function (Blueprint $table) {
            $table->dropForeign('Examen_id_Session_foreign');
            $table->dropForeign('Examen_id_Enseignant_foreign');
        });
        Schema::drop('Examen');
    }
}
