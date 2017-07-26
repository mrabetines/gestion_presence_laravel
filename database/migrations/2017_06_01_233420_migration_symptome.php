<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationSymptome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Symptome', function (Blueprint $table) {
            $table->increments('id_Symptome');
            $table->string('code', 10);
            $table->string('nom', 100);

            $table->integer('id_Systeme')->unsigned();
            $table->foreign('id_Systeme')->references('id_Systeme')->on('Systeme');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Symptome', function (Blueprint $table) {
            $table->dropForeign('Symptome_id_Systeme_foreign');
        });
        Schema::drop('Symptome');
    }
}
