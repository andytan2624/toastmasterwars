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

// The home page should be redirected to the score page
Route::get('/', 'ScoreController@dashboard');

// Users
Route::get('users', 'UserController@index');
Route::get('users/{id}', 'UserController@show');

// Score
Route::get('scores', 'ScoreController@index');

// Ajax function for typeahead
Route::get('findUser', 'SearchController@findUser');

Route::auth();

Route::group(['middleware' => 'App\Http\Middleware\SuperAdmin'], function(){
    // Users
    Route::get('users/create', 'UserController@create');
    Route::get('users/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::post('users', 'UserController@store');

    // Meetings
    Route::get('meetings', 'MeetingController@index');
    Route::get('meetings/create', 'MeetingController@create');
    Route::get('meetings/{id}', 'MeetingController@show');
    Route::get('meetings/edit/{id}', [ 'as' => 'meetings.edit', 'uses' => 'MeetingController@edit']);
    Route::post('meetings', 'MeetingController@store');

    // Scores
    Route::get('scores/create', 'ScoreController@create');
    Route::get('scores/{id}', 'ScoreController@show');
    Route::get('scores/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'ScoreController@edit']);
    Route::post('scores', 'ScoreController@store');
    Route::post('scores/search', 'ScoreController@index');
});

Route::group(['prefix' => 'api/v1'], function() {

    Route::get('users/{user_id}/scores', 'ScoreController@index');

    Route::resource('users', 'UserController');
    Route::resource('scores', 'ScoreController', ['only' => ['index', 'show']]);

});
