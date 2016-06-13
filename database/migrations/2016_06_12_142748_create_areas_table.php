<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code', 20)->nullable();
            $table->integer('division_id')->length(10)->unsigned();
            $table->timestamps();
        });

        Schema::table('areas', function (Blueprint $table) {
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
        });

        DB::table('areas')->insert(
            array(
                'id' => 1,
                'name' => 'Area 35',
                'division_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
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
        Schema::drop('areas');
    }
}
