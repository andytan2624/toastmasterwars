<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChairmanPoints extends Migration
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
                    'id'   => 29,
                    'name' => 'Chairman',
                    'active' => 1,
                ),
            )
        );
        DB::table('points')->insert(
            array(
                array(
                    'category_id'   => 29,
                    'active_since' => date('Y-m-d'),
                    'point_value'  => 3,
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
        //
        DB::table('points')->where('id', 29)->delete();
        DB::table('categories')->where('id', 29)->delete();

    }
}
