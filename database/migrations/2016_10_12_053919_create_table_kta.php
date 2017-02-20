<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableKta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner');            
            $table->string('kta');
            $table->string('requested_at');
            $table->string('granted_at');
            $table->timestamps();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kta');
    }
}
