<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraCategoriesPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('categories')->insert(
            array(
                array(
                    'id'   => 30,
                    'name' => 'Doing a Table Topics',
                    'active' => 1,
                ),
            )
        );
        DB::table('categories')->insert(
            array(
                array(
                    'id'   => 31,
                    'name' => 'Absent from Meeting',
                    'active' => 1,
                ),
            )
        );
        DB::table('categories')->insert(
            array(
                array(
                    'id'   => 32,
                    'name' => 'Apology for not Attending Meeting',
                    'active' => 1,
                ),
            )
        );
        DB::table('categories')->insert(
            array(
                array(
                    'id'   => 33,
                    'name' => 'Visitor Attending Meeting',
                    'active' => 1,
                ),
            )
        );
        DB::table('points')->insert(
            array(
                array(
                    'category_id'   => 30,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 1,
                ),
                array(
                    'category_id'   => 31,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 0,
                ),
                array(
                    'category_id'   => 32,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 0,
                ),
                array(
                    'category_id'   => 33,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 1,
                ),
            )
        );

        // Modify the categories category
        Schema::table('categories', function($table) {
            $table->string('slug', 100)->after('purpose')->nullable();
            $table->integer('meeting_order')->after('slug')->nullable();
        });

        // Now modify values for the slug and meeting order
        DB::table('categories')->where('id', 1)->update(['slug' => 'finishing_cc', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 2)->update(['slug' => 'finishing_cl', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 3)->update(['slug' => 'toastmaster_executive', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 4)->update(['slug' => 'speech_outside', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 5)->update(['slug' => 'active_mentor', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 6)->update(['slug' => 'speech', 'meeting_order' => 13 ]);
        DB::table('categories')->where('id', 7)->update(['slug' => 'competing_club_contest', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 8)->update(['slug' => 'compete_outside_contest', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 9)->update(['slug' => 'winning_club_contest', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 10)->update(['slug' => 'winning_outside_contest', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 11)->update(['slug' => 'special_contribution', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 12)->update(['slug' => 'table_topics_evaluation', 'meeting_order' => 16 ]);
        DB::table('categories')->where('id', 13)->update(['slug' => 'speech_evaluator', 'meeting_order' => 14 ]);
        DB::table('categories')->where('id', 14)->update(['slug' => 'table_topics_master', 'meeting_order' => 10 ]);
        DB::table('categories')->where('id', 15)->update(['slug' => 'general_evaluator', 'meeting_order' =>  21]);
        DB::table('categories')->where('id', 16)->update(['slug' => 'timer', 'meeting_order' => 15 ]);
        DB::table('categories')->where('id', 17)->update(['slug' => 'ah_counter', 'meeting_order' => 14 ]);
        DB::table('categories')->where('id', 18)->update(['slug' => 'toast', 'meeting_order' => 8 ]);
        DB::table('categories')->where('id', 19)->update(['slug' => 'grammarian', 'meeting_order' => 7 ]);
        DB::table('categories')->where('id', 20)->update(['slug' => 'riddle_master', 'meeting_order' => 6 ]);
        DB::table('categories')->where('id', 21)->update(['slug' => 'listening_post', 'meeting_order' => 20 ]);
        DB::table('categories')->where('id', 22)->update(['slug' => 'toastmaster', 'meeting_order' => 9 ]);
        DB::table('categories')->where('id', 23)->update(['slug' => 'table_topics_winner', 'meeting_order' => 12 ]);
        DB::table('categories')->where('id', 24)->update(['slug' => 'solved_riddle', 'meeting_order' => 19 ]);
        DB::table('categories')->where('id', 25)->update(['slug' => 'most_use_word', 'meeting_order' => 18 ]);
        DB::table('categories')->where('id', 26)->update(['slug' => 'attendance', 'meeting_order' => 2 ]);
        DB::table('categories')->where('id', 27)->update(['slug' => 'most_ahs', 'meeting_order' => 17 ]);
        DB::table('categories')->where('id', 28)->update(['slug' => 'bring_a_friend', 'meeting_order' => -1 ]);
        DB::table('categories')->where('id', 29)->update(['slug' => 'chairman', 'meeting_order' => 1 ]);
        DB::table('categories')->where('id', 30)->update(['slug' => 'doing_table_topics', 'meeting_order' => 11 ]);
        DB::table('categories')->where('id', 31)->update(['slug' => 'absent', 'meeting_order' => 4 ]);
        DB::table('categories')->where('id', 32)->update(['slug' => 'apology', 'meeting_order' => 3 ]);
        DB::table('categories')->where('id', 33)->update(['slug' => 'visitor', 'meeting_order' => 5 ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function($table) {
            $table->dropColumn('slug');
            $table->dropColumn('meeting_order');
        });

        DB::table('points')->where('id', 30)->delete();
        DB::table('categories')->where('id', 30)->delete();
        DB::table('points')->where('id', 31)->delete();
        DB::table('categories')->where('id', 31)->delete();
        DB::table('points')->where('id', 32)->delete();
        DB::table('categories')->where('id', 32)->delete();
        DB::table('points')->where('id', 33)->delete();
        DB::table('categories')->where('id', 33)->delete();
    }
}
