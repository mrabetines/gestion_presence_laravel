<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationEnseignantNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Enseignant_Notification', function (Blueprint $table) {
            $table->increments('id_Enseignant_Notification');
            $table->string('message');
            $table->integer('id_Enseignant')->unsigned();
            $table->foreign('id_Enseignant')->references('id_Enseignant')->on('Enseignant');

            $table->integer('id_Evaluateur')->unsigned();
            $table->foreign('id_Evaluateur')->references('id_Enseignant')->on('Enseignant');

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
        Schema::table('Enseignant_Notification', function (Blueprint $table) {
            $table->dropForeign('Enseignant_Notification_id_Evaluateur_foreign');
            $table->dropForeign('Enseignant_Notification_id_Enseignant_foreign');
            $table->dropForeign('Enseignant_Notification_id_Banque_foreign');
        });
        Schema::drop('Enseignant_Notification');
    }
}
