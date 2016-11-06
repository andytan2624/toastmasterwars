<?php

use App\Models\Area;
use App\Models\Club;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        foreach (range(1,5) as $index)
        {
            $areas = Area::lists('id')->all();
            $locale = $faker->locale;
            $slug = Str::slug($locale);
            Club::create([
                'name' => $locale,
                'code' => $faker->randomDigit,
                'area_id' => $faker->randomElement($areas),
                'slug' => $slug,
                'club_number' => $faker->numberBetween(1000, 123111),
                'address' => $faker->address
            ]);
        }

    }
}
