<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->boolean('active')->default(0);
            $table->string('name',50)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('periods')->insert(
            array(
                'start' => '2016-07-01',
                'end' => '2017-06-30',
                'active' => 1,
                'name' => '2016-2017 Season',
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
        Schema::drop('periods');
    }
}
