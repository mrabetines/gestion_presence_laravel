<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationBanque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Banque', function (Blueprint $table) {
            $table->increments('id_Banque');
            $table->string('label', 100);
            $table->text('situation_Clinique');
            $table->text('instruction_Etudiant');
            $table->text('instruction_MedObservateur');
            $table->text('scenarios_Patient');
            $table->text('consigne');
            $table->text('diagnostic');

            $table->integer('status');
            $table->integer('modify');


            $table->integer('id_Domaine')->unsigned();
            $table->foreign('id_Domaine')->references('id_Domaine')->on('Domaine');

            $table->integer('id_Critere')->unsigned();
            $table->foreign('id_Critere')->references('id_Critere')->on('Critere');

            $table->integer('id_Systeme')->unsigned();
            $table->foreign('id_Systeme')->references('id_Systeme')->on('Systeme');

            $table->integer('id_Contexte')->unsigned();
            $table->foreign('id_Contexte')->references('id_Contexte')->on('Contexte');

            $table->integer('id_Niveau')->unsigned();
            $table->foreign('id_Niveau')->references('id_Niveau')->on('Niveau');

            $table->integer('id_BanqueType')->unsigned();
            $table->foreign('id_BanqueType')->references('id_BanqueType')->on('BanqueType');

            $table->integer('id_Plainte')->unsigned();
            $table->foreign('id_Plainte')->references('id_Plainte')->on('Plainte');

            $table->integer('id_Proprietaire')->unsigned();
            $table->foreign('id_Proprietaire')->references('id_Enseignant')->on('Enseignant');
            
            $table->integer('id_Evaluateur')->unsigned();
            $table->foreign('id_Evaluateur')->references('id_Enseignant')->on('Enseignant');

            $table->date('created_at');
            $table->date('updated_at');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Banque', function (Blueprint $table) {
            $table->dropForeign('Banque_id_Domaine_foreign');
            $table->dropForeign('Banque_id_Critere_foreign');
            $table->dropForeign('Banque_id_Systeme_foreign');
            $table->dropForeign('Banque_id_Contexte_foreign');
            $table->dropForeign('Banque_id_BanqueType_foreign');
            $table->dropForeign('Banque_id_Plainte_foreign');
        });
        Schema::drop('Banque');
    }
}
