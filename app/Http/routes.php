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

Route::auth();

// The home page should be redirected to the score page
Route::get('/', 'ScoreController@dashboard');
Route::post('/', 'ScoreController@dashboard');

// Users
Route::get('users', 'UserController@index');
Route::get('users/view', 'UserController@view')->name('users.view');
Route::get('users/display/{id}', 'UserController@show');

// Score
Route::get('scores', 'ScoreController@index');

// Reporting
Route::get('reporting', 'ReportingController@view')->name('reporting.management.view');
Route::post('reporting', 'ReportingController@view')->name('reporting.management.process');

// Meetings
Route::get('meetings', 'MeetingController@index');
Route::get('meetings/{id}', 'MeetingController@show')->name('meeting.show');

Route::group(['middleware' => 'App\Http\Middleware\SuperAdmin'], function(){
    // Users
    Route::get('users/create', 'UserController@create');
    Route::post('users/delete/{id}', 'UserController@delete')->name('users.management.delete');
    Route::get('users/edit/{id}', 'UserController@edit')->name('users.management.edit');
    Route::post('users/edit/{id}', 'UserController@update')->name('users.management.update');
    Route::post('users', 'UserController@store')->name('users.management.store');

    // Meetings
    Route::get('meetings/create', 'MeetingController@create');
    Route::get('meetings/edit/{id}', [ 'as' => 'meetings.edit', 'uses' => 'MeetingController@edit']);
    Route::post('meetings', 'MeetingController@store');

    // Scores
    Route::get('scores/create', 'ScoreController@create');
    Route::get('scores/{id}', 'ScoreController@show');
    Route::get('scores/edit/{id}', [ 'as' => 'scores.edit', 'uses' => 'ScoreController@edit']);
    Route::post('scores', 'ScoreController@store');

    // Ajax function for typeahead
    Route::get('findUser', 'SearchController@findUser');
});

Route::group(['prefix' => 'api/v1'], function() {

    Route::get('users/{user_id}/scores', 'ScoreController@index');

    Route::resource('users', 'UserController');
    Route::resource('scores', 'ScoreController', ['only' => ['index', 'show']]);

});
