<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLevelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->integer('points_required')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('levels')->insert(
            array(
                array(
                    'name'            => 'Bronze',
                    'points_required' => 50,
                ),
                array(
                    'name'            => 'Silver',
                    'points_required' => 100,
                ),
                array(
                    'name'            => 'Gold',
                    'points_required' => 200,
                ),
                array(
                    'name'            => 'Platinum',
                    'points_required' => 350,
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
        Schema::drop('levels');
    }
}
