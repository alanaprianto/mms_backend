<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFormResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_result', function ($table) {
            $table->dropColumn('id_answer');
            $table->dropColumn('description');            
            $table->text('answer_value')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_result', function ($table) {
            $table->integer('id_answer')->nullable();
            $table->text('description')->nullable();            
            $table->dropColumn('answer_value');            
        });
    }
}
