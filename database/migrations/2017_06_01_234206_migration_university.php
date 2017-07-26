<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MigrationUniversity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('University', function (Blueprint $table) {
            $table->increments('id_University');
            $table->string("label", 100);
            $table->string("region", 100);
            $table->string('login', 100);
            $table->string('password', 100);
            $table->string('password_non_crypted', 100);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('University');
    }
}
