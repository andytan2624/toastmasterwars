<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'HomeController@index');

// All Routes go through TempController to make sure we get data saved into the database
Route::get('/', 'ScoreController@index');

// Users
Route::get('users', 'UserController@index');
Route::get('users/create', 'UserController@create');
Route::get('users/{id}', 'UserController@show');
Route::get('users/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'UserController@edit']);
Route::post('users', 'UserController@store');

// Meetings
Route::get('meetings', 'MeetingController@index');
Route::get('meetings/create', 'MeetingController@create');
Route::get('meetings/{id}', 'MeetingController@show');
Route::get('meetings/edit/{id}', [ 'as' => 'meetings.edit', 'uses' => 'MeetingController@edit']);
Route::post('meetings', 'MeetingController@store');


// Score
Route::get('scores', 'ScoreController@index');
Route::get('scores/create', 'ScoreController@create');
Route::get('scores/{id}', 'ScoreController@show');
Route::get('scores/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'ScoreController@edit']);
Route::post('scores', 'ScoreController@store');
Route::post('scores/search', 'ScoreController@index');

Route::get('findUser', 'SearchController@findUser');

//Route::get('/api/flights/{id}', function ($id) {
//    return App\Flight::findOrFail($id);
//});