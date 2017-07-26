<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationNoteItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Note_Item', function(Blueprint $table) {
            $table->increments('id_Note_Item');
            $table->integer('note')->default(0);

            $table->integer('id_Item')->unsigned();
            $table->foreign('id_Item')->references('id_Item')->on('Item');

            $table->integer('id_Note_Station')->unsigned();
            $table->foreign('id_Note_Station')->references('id_Note_Station')->on('Note_Station');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Note_Item', function(Blueprint $table) {
            $table->dropForeign('Note_Item_id_Item_foreign');
            $table->dropForeign('Note_Item_id_Note_Station_foreign');
        });
        Schema::drop('Note_Item');
    }
}
