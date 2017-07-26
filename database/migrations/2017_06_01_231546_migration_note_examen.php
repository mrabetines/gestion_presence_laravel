<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNoteExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Note_Examen', function (Blueprint $table) {
            $table->increments('id_Note_Examen');
            $table->float('note')->default(0);

            $table->integer('id_Examen')->unsigned();
            $table->foreign('id_Examen')->references('id_Examen')->on('Examen');

            $table->integer('id_Session')->unsigned();
            $table->foreign('id_Session')->references('id_Session')->on('Session');

            $table->integer('id_Etudiant')->unsigned();
            $table->foreign('id_Etudiant')->references('id_Etudiant')->on('Etudiant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Note_Examen', function (Blueprint $table) {
            $table->dropForeign('Note_Examen_id_Examen_foreign');
            $table->dropForeign('Note_Examen_id_Session_foreign');
            $table->dropForeign('Note_Examen_id_Etudiant_foreign');
        });
        Schema::drop('Note_Examen');
    }
}
