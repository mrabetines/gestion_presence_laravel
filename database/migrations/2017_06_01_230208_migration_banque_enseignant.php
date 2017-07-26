<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationBanqueEnseignant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Banque_Enseignant', function (Blueprint $table) {
            $table->increments('id_Banque_Enseignant');


            $table->integer('id_Enseignant')->unsigned();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

            $table->integer('id_Banque')->unsigned();
            $table->foreign('id_Banque')->references('id_Banque')->on('Banque');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Banque_Enseignant', function (Blueprint $table) {
            $table->dropForeign('Banque_Enseignant_id_Enseignant_foreign');
            $table->dropForeign('Banque_Enseignant_id_Banque_foreign');

        });
    }
}
