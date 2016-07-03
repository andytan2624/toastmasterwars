<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->length(10)->unsigned();
            $table->date('active_since')->nullable();
            $table->integer('point_value')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('points', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        // Insert some stuff
        DB::table('points')->insert(
            array(
                array(
                    'category_id'  => 1,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 15,
                ),
                array(
                    'category_id'  => 2,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 15,
                ),
                array(
                    'category_id'  => 3,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 12,
                ),
                array(
                    'category_id'  => 4,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 10,
                ),
                array(
                    'category_id'  => 5,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 7,
                ),
                array(
                    'category_id'  => 6,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 7,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 8,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 9,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 10,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 11,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 12,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 13,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
                ),
                array(
                    'category_id'  => 14,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 3,
                ),
                array(
                    'category_id'  => 15,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 3,
                ),
                array(
                    'category_id'  => 16,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 17,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 18,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 19,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 20,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 21,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 22,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 23,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 2,
                ),
                array(
                    'category_id'  => 24,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 1,
                ),
                array(
                    'category_id'  => 25,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 1,
                ),
                array(
                    'category_id'  => 26,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 1,
                ),
                array(
                    'category_id'  => 27,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => - 1,
                ),
                array(
                    'category_id'  => 28,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 5,
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
        Schema::drop('points');
    }
}
