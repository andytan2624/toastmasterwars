<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    protected $table = 'countries';

    public function index()
    {
        $countries = Country::all();

        //$flights = App\Flight::where('active', 1)
        //    ->orderBy('name', 'desc')
        //    ->take(10)
        //    ->get();

        // echo $flight->name;

        // Retrieve a model by its primary key...
        //$flight = App\Flight::find(1);

// Retrieve the first model matching the query constraints...
//        $flight = App\Flight::where('active', 1)->first();

        //$model = App\Flight::findOrFail(1);

        //$model = App\Flight::where('legs', '>', 100)->firstOrFail();

        //$count = App\Flight::where('active', 1)->count();
        //
        //$max = App\Flight::where('active', 1)->max('price');
    }

    public function store(Request $request) {
        //$country = new Country();
        //
        //$country->name = $request->name;
        //$country->save();
    }

//$flight = App\Flight::find(1);
//
//$flight->name = 'New Flight Name';
//
//$flight->save();

//App\Flight::where('active', 1)
//->where('destination', 'San Diego')
//->update(['delayed' => 1]);

//Soft deletes
//Schema::table('flights', function ($table) {
//    $table->softDeletes();
//});

}
