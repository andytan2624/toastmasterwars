<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code', 20)->nullable();
            $table->integer('area_id')->length(10)->unsigned();
            $table->string('slug', 150)->nullable();
            $table->integer('club_number')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();
        });

        Schema::table('clubs', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });

        DB::table('clubs')->insert(
            array(
                'id' => 1,
                'name' => 'Cabra-Vale Toastmasters Club',
                'area_id' => 1,
                'slug' => 'cabra-vale',
                'club_number' => '1071659',
                'address' => 'Cabra-Vale Digger\'s Club 1 Bartley St Canley Vale, New South Wales 2166 Australia',
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
        Schema::drop('clubs');
    }
}
