<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->length(10)->unsigned();
            $table->integer('user_id')->length(10)->unsigned();
            $table->boolean('main_club')->default(0);
            $table->boolean('is_member')->default(0);
            $table->boolean('is_club_admin')->default(0);
            $table->date('date_joined')->nullable();
            $table->date('date_left')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->foreign('club_id', 'user_clubs_club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('user_id', 'user_clubs_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_clubs');
    }
}
