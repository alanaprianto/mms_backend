<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableRegnumChangeRn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regnum', function ($table) {
            $table->renameColumn('rn', 'regnum');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regnum', function ($table) {
           $table->renameColumn('regnum', 'rn');
        });
    }
}
