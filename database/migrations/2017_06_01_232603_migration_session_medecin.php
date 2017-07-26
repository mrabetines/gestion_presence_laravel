<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationSessionMedecin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Session_Medecin', function (Blueprint $table) {
            $table->increments('id_Session_Medecin');

            $table->integer('id_Enseignant')->unsigned();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

            $table->integer('id_Session')->unsigned();
            $table->foreign('id_Session')->references('id_Session')->on('Session');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Session_Medecin', function (Blueprint $table) {
            $table->dropForeign('Session_Medecin_id_Session_foreign');
            $table->dropForeign('Session_Medecin_id_Enseignant_foreign');
        });
        Schema::drop('Session_Medecin');
    }
}
