<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExecutiveRolesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('executive_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('executive_roles')->insert(
            array(
                array(
                    'name' => 'President',
                ),
                array(
                    'name' => 'Vice President of Education',
                ),
                array(
                    'name' => 'Vice President of Membership',
                ),
                array(
                    'name' => 'Vice President of Public Relations',
                ),
                array(
                    'name' => 'Treasurer',
                ),
                array(
                    'name' => 'Secretary',
                ),
                array(
                    'name' => 'Sergeant At Arms',
                ),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('executive_roles');
    }
}
