<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFormResultAddCorrectionAndCommentary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_result', function ($table) {
            $table->string('correction')->nullable();
            $table->string('commentary')->nullable();
            $table->integer('validated_by')->nullable();            
            $table->string('validated_at')->nullable();
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
            $table->dropColumn('correction');
            $table->dropColumn('commentary');
            $table->dropColumn('validated_by');            
            $table->dropColumn('validated_at');
        });
    }
}
