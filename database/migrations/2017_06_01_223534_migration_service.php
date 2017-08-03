<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Service', function (Blueprint $table) {
            $table->increments('id_Service');
            $table->string('nom', 100);


            $table->integer('id_Hopital')->unsigned();
            $table->foreign('id_Hopital')->references('id_Hopital')->on('Hopital');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Service', function (Blueprint $table) {
            $table->dropForeign('Service_id_Hopital_foreign');
        });

        Schema::drop('Service');

    }
}
