<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');

// The home page should be redirected to the score page
Route::get('/', 'ScoreController@dashboard');
Route::post('/', 'ScoreController@dashboard');

// Users
Route::get('users', 'UserController@index');
Route::get('users/view', 'UserController@view')->name('users.view');
Route::get('users/display/{id}', 'UserController@show');

// Score
Route::get('scores', 'ScoreController@index');
Route::get('scores/breakdown', 'ScoreController@breakdown');

// Reporting
Route::get('reporting', 'ReportingController@view')->name('reporting.management.view');
Route::post('reporting', 'ReportingController@view')->name('reporting.management.process');

// Meetings
Route::get('meetings', 'MeetingController@index')->name('meetings.view');
Route::get('meetings/{id}/show', 'MeetingController@show')->name('meeting.show');

Route::group(['middleware' => 'App\Http\Middleware\SuperAdmin'], function(){
    // Users
    Route::get('users/create', 'UserController@create');
    Route::post('users/delete/{id}', 'UserController@delete')->name('users.management.delete');
    Route::get('users/edit/{id}', 'UserController@edit')->name('users.management.edit');
    Route::post('users/edit/{id}', 'UserController@update')->name('users.management.update');
    Route::post('users', 'UserController@store')->name('users.management.store');

    // Meetings
    Route::get('meetings/create', 'MeetingController@create')->name('meeting.create');
    Route::get('meetings/{id}/edit', 'MeetingController@edit')->name('meetings.edit');
    Route::post('meetings/{id}/edit', 'MeetingController@update')->name('meetings.update');
    Route::post('meetings/{id}/delete', 'MeetingController@destroy')->name('meetings.delete');
    Route::post('meetings', 'MeetingController@store');
    Route::get('meetings/{meetingId}/editScores/{categoryId}', 'MeetingController@editScores')->name('meetings.editScores');
    Route::post('meetings/{meetingId}/editScores/{categoryId}', 'MeetingController@updateScores')->name('meetings.editScores');
    Route::post('meetings/deleteScore/{scoreId}', 'MeetingController@deleteScore')->name('meetings.deleteScore');

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
