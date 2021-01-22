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

Route::prefix('dashboard')->group(function () {
	Route::middleware(['auth', 'authCore'])->group(function () {
		Route::get('/', 'DashboardController@index')->name('dashboard.index');
		Route::get('/create', 'DashboardController@create')->name('dashboard.create');
		Route::get('/get', 'DashboardController@get')->name('dashboard.get');
		Route::get('/single_data/{id}', 'DashboardController@get_single_data')->name('dashboard.single_data');
		Route::get('/show/{id}', 'DashboardController@show')->name('dashboard.show');
		Route::get('/edit/{id}', 'DashboardController@edit')->name('dashboard.edit');
		Route::post('/store', 'DashboardController@store')->name('dashboard.store');
		Route::post('/update/{id}', 'DashboardController@update')->name('dashboard.update');
		Route::post('/delete/{id}', 'DashboardController@delete')->name('dashboard.delete');
		Route::get('/getorder', 'DashboardController@getorder')->name('dashboard.getorder');
		Route::get('/getartikel', 'DashboardController@getartikel')->name('dashboard.getartikel');
	});
});
