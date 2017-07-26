<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationEtudiantExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Etudiant_Examen', function (Blueprint $table) {
            $table->increments('id_Etudiant_Examen');

            $table->integer('id_Etudiant')->unsigned();
            $table->foreign('id_Etudiant')->references('id_Etudiant')->on('Etudiant');

            $table->integer('id_Examen')->unsigned();
            $table->foreign('id_Examen')->references('id_Examen')->on('Examen');
			
			$table->boolean('present')->default(False);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Etudiant_Examen', function(Blueprint $table) {
            $table->dropForeign('Etudiant_Examen_id_Etudiant_foreign');
            $table->dropForeign('Etudiant_Examen_id_Examen_foreign');
        });
        Schema::drop('Etudiant_Examen');
    }
}
