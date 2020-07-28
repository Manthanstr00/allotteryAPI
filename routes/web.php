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

Route::group(['middleware' => ['auth']], function () {

        Route::get('/','HomeController@index')->name('home');
        Route::get('dashboard','AdminController@index')->name('dashboard');
        Route::get('host','AdminController@hostContest')->name('host');
        Route::get('hosted','AdminController@hostedContests')->name('hosted');
        Route::get('trending','AdminController@trendingContests')->name('trending');

    });