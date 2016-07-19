<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMentorExecutiveScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('points')->where('id', 3)->update(['point_value' => 5]);
        DB::table('points')->where('id', 5)->update(['point_value' => 3]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('points')->where('id', 3)->update(['point_value' => 12]);
        DB::table('points')->where('id', 5)->update(['point_value' => 7]);
    }
}
