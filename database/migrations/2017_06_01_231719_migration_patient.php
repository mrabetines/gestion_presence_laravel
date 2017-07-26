<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patient_Simule', function (Blueprint $table) {
            $table->increments('id_Patient_Simule');
            $table->integer('CIN');
            $table->string('nom');
            $table->string('prenom');

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
        Schema::table('Patient_Simule', function (Blueprint $table) {
            $table->dropForeign('Patient_Simule_id_Session_foreign');
        });
        Schema::drop('Patient_Simule');
    }
}
