<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->length(10)->unsigned();
            $table->integer('user_id')->length(10)->unsigned();
            $table->integer('level_id')->length(10)->unsigned();
            $table->integer('period_id')->length(10)->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('user_levels', function (Blueprint $table) {
            $table->foreign('club_id', 'user_levels_club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('user_id', 'user_levels_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_levels');
    }
}
