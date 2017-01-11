<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\Score;
use App\Models\User;
use Illuminate\Support\Facades\DB;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->safeEmail,
        'member_number' => $faker->numberBetween(12,123123),
        'date_joined' => $faker->date('Y-m-d'),
    ];
});

$factory->defineAs(App\Models\Score::class, 'speech', function(Faker\Generator $faker) {
   return [
       'user_id' => rand(1,20),
       'club_id' => 1,
       'meeting_id' => 0,
       'point_id' => 0,
       'point_value' => 0,
       'is_speech' => true,
       'evaluator' => rand(1,20),
       'speech_title' => $faker->sentence,
       'speaking_time' => $faker->time('H:i')
   ];
});