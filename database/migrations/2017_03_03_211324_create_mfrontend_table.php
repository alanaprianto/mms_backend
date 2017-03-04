<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMfrontendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mfrontend', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('cat_id')->nullable();
            $table->string('name');
            $table->integer('position');
            $table->string('description');
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
        Schema::drop('mfrontend');
    }
}
