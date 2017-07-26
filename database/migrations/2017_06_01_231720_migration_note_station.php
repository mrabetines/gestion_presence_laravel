<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNoteStation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Note_Station', function (Blueprint $table) {
            $table->increments('id_Note_Station');
            $table->integer('note')->default(0);

            $table->integer('id_Station')->unsigned();
            $table->foreign('id_Station')->references('id_Station')->on('Station');

            $table->integer('id_Note_Examen')->unsigned();
            $table->foreign('id_Note_Examen')->references('id_Note_Examen')->on('Note_Examen');

            $table->integer('id_Enseignant')->unsigned();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

            $table->integer('id_Patient_Simule')->unsigned();
            $table->foreign('id_Patient_Simule')->references('id_Patient_Simule')->on('Patient_Simule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Note_Station', function (Blueprint $table) {
            $table->dropForeign('Note_Station_id_Station_foreign');
            $table->dropForeign('Note_Station_id_Note_Examen_foreign');
            $table->dropForeign('Note_Station_id_Enseignant_foreign');
            $table->dropForeign('Note_Station_id_Patient_Simule_foreign');
        });
        Schema::drop('Note_Station');
    }
}
