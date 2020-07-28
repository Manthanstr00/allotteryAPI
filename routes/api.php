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
Route::post('user/signup','UserController@createUser');
Route::post('user/signin','UserController@signIn');
Route::post('user/update/{id}','UserController@updateUserDetail');
Route::get('user/id/{phone}', 'UserController@getUserId');
Route::get('user/history/{id}','UserController@history');
Route::get('user/stat/{id}','UserController@userStats');

//Contest Routes
Route::get('contest','ContestController@getContests');
Route::post('contest','ContestController@hostContest');
Route::get('contest/ended','ContestController@endedContest');
Route::get('contest/live/{id}','ContestController@liveContest');
Route::get('contest/winner/{contestId}','ContestController@contestWinner');
Route::get('contest/grand/live','ContestController@liveGrandContests');
Route::get('contest/winners','ContestController@contestWinners');

//Favourite contest controller
Route::get('contest/favourite/{id}','FavouriteController@favouriteContests');
Route::post('contest/favourite','FavouriteController@addFavourite');
Route::get('contest/favourite/{contest_id}/{user_id}','FavouriteController@removeFavourite');

//Trending contest controller
Route::get('contest/trending','TrendingController@trendingContests');
Route::post('contest/trending','TrendingController@addTrending');
Route::get('contest/trending/{id}','TrendingController@removeTrending');

//Advertisements Routes
Route::get('advertise','AdvertiseController@fetchAdvertise');
Route::post('advertise','AdvertiseController@createAdvertise');

//ShowcaseImages Routes
Route::get('showcase','ShowcaseImageController@fetchShowcaseImage');
Route::post('showcase','ShowcaseImageController@addShowcaseImage');







