<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpeechIdColumnToScores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function($table) {
            $table->integer('evaluated_speech_id')->nullable()->unsigned();;
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->foreign('evaluated_speech_id')->references('id')->on('scores')->onDelete('cascade');
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
            $table->dropColumn('evaluated_speech_id');
        });
    }
}
