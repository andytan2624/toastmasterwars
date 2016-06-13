<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutiveRoleClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive_role_clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('club_id')->length(10)->unsigned();
            $table->integer('user_id')->length(10)->unsigned();
            $table->integer('executive_role_id')->length(10)->unsigned();
            $table->timestamps();
        });

        Schema::table('executive_role_clubs', function (Blueprint $table) {
            $table->foreign('club_id', 'executive_role_clubs_club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('user_id', 'executive_role_clubs_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('executive_role_id')->references('id')->on('executive_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('executive_role_clubs');
    }
}
