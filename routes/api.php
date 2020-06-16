<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


//Users Routes
Route::get('user','UserController@getUsers');
Route::get('user/{id}','UserController@getUser');
Route::post('user','UserController@createUser');
Route::post('user/fcm/{id}','UserController@updateUserDetail');
Route::get('user/id/{phone}', 'UserController@getUserId');

//Contest Routes
Route::get('contest','ContestController@getContests');
Route::post('contest','ContestController@hostContest');
Route::get('contest/ended','ContestController@endedContest');
Route::get('contest/live','ContestController@liveContest');
Route::get('contest/winner','ContestController@contestWinner');



