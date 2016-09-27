<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomPointsCategory extends Migration
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
                    'id'   => 34,
                    'name' => 'Custom Point',
                    'active' => 1,
                ),
            )
        );
        DB::table('points')->insert(
            array(
                array(
                    'category_id'   => 34,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 0,
                ),
            )
        );

        // Now modify values for the slug and meeting order
        DB::table('categories')->where('id', 34)->update(['slug' => 'custom', 'meeting_order' => -1 ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('points')->where('id', 34)->delete();
        DB::table('categories')->where('id', 34)->delete();
    }
}
