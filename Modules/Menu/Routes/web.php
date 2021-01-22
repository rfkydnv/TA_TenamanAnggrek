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

    Route::prefix('master/menu')->group(function() {
        Route::middleware(['auth','authCore'])->group(function()
        {
            Route::get('/', 'MenuController@index')->name('menu.index');
            Route::get('/select2', 'MenuController@select2')->name('menu.select2');
            Route::get('/getIcon', 'MenuController@getIcon')->name('menu.getIcon');
            Route::get('/selecticon', 'MenuController@selecticon')->name('menu.selecticon');
            Route::get('/edit/{id}', 'MenuController@edit')->name('menu.edit');
            Route::get('/get_single_data/{id}', 'MenuController@get_single_data')->name('menu.get_single_data');
            Route::post('/store', 'MenuController@store')->name('menu.store');
            Route::post('/update/{id}', 'MenuController@update')->name('menu.update');
            Route::delete('/delete/{id}', 'MenuController@delete')->name('menu.delete');
            Route::delete('/delete-bulk/{id}', 'MenuController@bulkDelete')->name('menu.delete.bulk');
        });
    });
