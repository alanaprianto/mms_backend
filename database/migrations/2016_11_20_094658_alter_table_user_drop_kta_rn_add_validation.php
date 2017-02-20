<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserDropKtaRnAddValidation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('no_kta');
            $table->dropColumn('no_rn');            
            $table->string('validation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->string('no_kta')->nullable();
            $table->string('no_rn')->nullable();
            $table->dropColumn('validation');
        });
    }
}
