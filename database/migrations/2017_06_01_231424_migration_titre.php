<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationTitre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TitreGItem', function (Blueprint $table) {
            $table->increments('id_TitreGItem');
            $table->string('nom', 100);
            $table->integer('ponderation');
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
        Schema::drop('TitreGItem');
    }
}
