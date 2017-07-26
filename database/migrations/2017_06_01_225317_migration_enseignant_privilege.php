<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationEnseignantPrivilege extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enseignant_Privilege', function (Blueprint $table) {
            $table->increments('id_Enseignant_Privilege');


            $table->integer('id_Enseignant')->unsigned();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

            $table->integer('id_Privilege')->unsigned();
            $table->foreign('id_Privilege')->references('id_Privilege')->on('Privilege');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Enseignant_Privilege', function (Blueprint $table) {
            $table->dropForeign('Enseignant_Privilege_id_Enseignant_foreign');
            $table->dropForeign('Enseignant_Privilege_id_Privilege_foreign');
        });
        Schema::drop('Enseignant_Privilege');
    }
}
