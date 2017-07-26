<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationEnseignant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enseignant', function (Blueprint $table) {
            $table->increments('id_Enseignant');
            $table->integer('CIN');
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('passwordDecrypt',20);
            $table->string('qr_code',100);


            $table->integer('id_Service')->unsigned();
            $table->foreign('id_Service')->references('id_Service')->on('Service');

            $table->integer('id_Grade')->unsigned();
            $table->foreign('id_Grade')->references('id_Grade')->on('Grade');

            $table->integer('id_Specialite')->unsigned();
            $table->foreign('id_Specialite')->references('id_Specialite')->on('Specialite');
            // auth fields
            $table->string('login', 100);
            $table->string('password', 100);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Enseignant', function (Blueprint $table) {
            $table->dropForeign('Enseignant_id_Service_foreign');
            $table->dropForeign('Enseignant_id_Specialite_foreign');
            $table->dropForeign('Enseignant_id_Grade_foreign');
        });
        Schema::drop('Enseignant');
    }
}
