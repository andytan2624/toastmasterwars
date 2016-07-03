<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->length(10)->unsigned();
            $table->integer('chairman')->length(10)->unsigned();
            $table->integer('serjeant_at_arms')->length(10)->unsigned();
            $table->integer('secretary')->length(10)->unsigned();
            $table->integer('meeting_number')->nullable();
            $table->date('meeting_date')->nullable();
            $table->time('meeting_start_time')->nullable();
            $table->time('meeting_end_time')->nullable();
            $table->text('theme')->nullable();
            $table->text('business_session')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('chairman')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('serjeant_at_arms')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('secretary')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meetings');
    }
}
