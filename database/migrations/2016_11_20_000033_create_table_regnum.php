<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRegnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regnum', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner');
            $table->string('rn');
            $table->string('requested_at');
            $table->string('granted_at');
            $table->string('expired_at')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::drop('regnum');
    }
}
