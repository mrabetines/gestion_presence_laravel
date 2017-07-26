<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Item', function(Blueprint $table) {
            $table->increments('id_Item');
            $table->integer('valeur');
            $table->string('label',250);

            $table->integer('id_Competence')->unsigned();
            $table->foreign('id_Competence')->references('id_Competence')->on('Competence');

            $table->integer('id_TitreGItem')->unsigned();
            $table->foreign('id_TitreGItem')->references('id_TitreGItem')->on('TitreGItem');

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
        Schema::table('Item', function(Blueprint $table) {
            $table->dropForeign('Item_id_Competence_foreign');
            $table->dropForeign('Item_id_TitreGItem_foreign');
            $table->dropForeign('Item_id_Banque_foreign');
        });
        Schema::drop('Item');
    }
}
