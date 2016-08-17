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

/*
 * A good way to include parameters in all views you need
View::composer('stats', function($view) {
   $view->with('stats', app('App\Stats'));
}


 */

Route::group(['middleware' => ['web']], function() {

   Route::get('/', 'HomeController@index');

   // Users
   Route::get('users', 'UserController@index');
   Route::get('users/create', 'UserController@create');
   Route::get('users/{id}', 'UserController@show');
   Route::get('users/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'UserController@edit']);
   Route::post('users', 'UserController@store');
   Route::patch('users/{user}', [ 'as' => 'users.update', 'uses' => 'UserController@update']);

   Route::get('pousers/{user}', function(App\Models\User $user) {
      return $user;
   });

   // Meetings
   Route::get('meetings', 'MeetingController@index');
   Route::get('meetings/create', 'MeetingController@create');
   Route::get('meetings/{id}', 'MeetingController@show');
   Route::get('meetings/edit/{id}', [ 'as' => 'meetings.edit', 'uses' => 'MeetingController@edit']);
   Route::post('meetings', 'MeetingController@store');

   Route::group(array('prefix' => 'api/v1'), function()
   {
      Route::resource('meetings', 'MeetingController');
   });


   // Score
   Route::get('scores', 'ScoreController@index');
   Route::get('scores/create', 'ScoreController@create');
   Route::get('scores/{score}', 'ScoreController@show');
   Route::get('scores/edit/{id}', [ 'as' => 'users.edit', 'uses' => 'ScoreController@edit']);
   Route::post('scores', 'ScoreController@store');

   // Authentication and Logging In
   Route::auth();

   Route::get('/home', 'HomeController@index');

   // Admin Area
   Route::group(['prefix' => 'admin', 'as' => 'Admin::'], function() {
      Route::get('home', ['as' => 'home', function() {
         return 'some_view';
      }]);
   });

   Route::get('find', 'SearchController@find');
});


