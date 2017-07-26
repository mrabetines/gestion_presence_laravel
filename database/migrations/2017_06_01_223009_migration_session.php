<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationSession extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Session', function (Blueprint $table) {
            $table->increments('id_Session');
            $table->string('nom', 20);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_publication');
            $table->date('date_fin_inscription');
            $table->time('time_publication');
            $table->time('time_fin_inscription');

            $table->integer('id_Niveau')->unsigned();
            $table->foreign('id_Niveau')->references('id_Niveau')->on('Niveau');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Session', function (Blueprint $table) {
            $table->dropForeign('Session_id_Niveau_foreign');
        });
        Schema::drop('Session');
    }
}
