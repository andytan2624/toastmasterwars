<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('purpose')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('deleted')->default(0);
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                array(
                    'id'     => 1,
                    'name'   => 'Finishing CC Manual',
                    'active' => 1,
                ),
                array(
                    'id'   => 2,
                    'name' => 'Finishing CL Manual',

                    'active' => 1,
                ),
                array(
                    'id'   => 3,
                    'name' => 'Being a Toastmaster Executive',

                    'active' => 1,
                ),
                array(
                    'id'   => 4,
                    'name' => 'Doing Speech Outside Club',

                    'active' => 1,
                ),
                array(
                    'id'   => 5,
                    'name' => 'Active mentor',

                    'active' => 1,
                ),
                array(
                    'id'   => 6,
                    'name' => 'Speech',

                    'active' => 1,
                ),
                array(
                    'id'   => 7,
                    'name' => 'Competing in Club Contest',

                    'active' => 1,
                ),
                array(
                    'id'   => 8,
                    'name' => 'Competing in Outside Contest',

                    'active' => 1,
                ),
                array(
                    'id'   => 9,
                    'name' => 'Winning Club Contest',

                    'active' => 1,
                ),
                array(
                    'id'   => 10,
                    'name' => 'Winning Outside Contest',

                    'active' => 1,
                ),
                array(
                    'id'   => 11,
                    'name' => 'Special Contribution To Club',

                    'active' => 1,
                ),
                array(
                    'id'   => 12,
                    'name' => 'Table Topics Evaluation',

                    'active' => 1,
                ),
                array(
                    'id'   => 13,
                    'name' => 'Speech Evaluation',

                    'active' => 1,
                ),
                array(
                    'id'   => 14,
                    'name' => 'Table Topics Master',

                    'active' => 1,
                ),
                array(
                    'id'   => 15,
                    'name' => 'General Evaluator',

                    'active' => 1,
                ),
                array(
                    'id'   => 16,
                    'name' => 'Timer',

                    'active' => 1,
                ),
                array(
                    'id'   => 17,
                    'name' => 'Ah Counter',

                    'active' => 1,
                ),
                array(
                    'id'   => 18,
                    'name' => 'Toast',

                    'active' => 1,
                ),
                array(
                    'id'   => 19,
                    'name' => 'Grammarian',

                    'active' => 1,
                ),
                array(
                    'id'   => 20,
                    'name' => 'Riddle Master',

                    'active' => 1,
                ),
                array(
                    'id'   => 21,
                    'name' => 'Listening Post',

                    'active' => 1,
                ),
                array(
                    'id'   => 22,
                    'name' => 'Toastmaster',

                    'active' => 1,
                ),
                array(
                    'id'   => 23,
                    'name' => 'Winning Table Topics',

                    'active' => 1,
                ),
                array(
                    'id'   => 24,
                    'name' => 'Solving Riddle',

                    'active' => 1,
                ),
                array(
                    'id'   => 25,
                    'name' => 'Most Use of the Word of the Day',

                    'active' => 1,
                ),
                array(
                    'id'   => 26,
                    'name' => 'Attended Meeting',

                    'active' => 1,
                ),
                array(
                    'id'   => 27,
                    'name' => 'Most Ahs',

                    'active' => 1,
                ),
                array(
                    'id'   => 28,
                    'name' => 'Bring a Friend',
                    'active' => 1,
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
        Schema::drop('categories');
    }
}
