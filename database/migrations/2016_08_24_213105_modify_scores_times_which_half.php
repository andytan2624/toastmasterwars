<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyScoresTimesWhichHalf extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function($table) {
            $table->time('speaking_time')->nullable();
            $table->enum('which_half', array( 1, 2))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function($table) {
            $table->dropColumn('speaking_time');
            $table->dropColumn('which_half');
        });
    }
}
