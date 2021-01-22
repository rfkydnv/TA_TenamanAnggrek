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
Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function () {
    return view('mahasiswa.test');
});


Route::get('/mahasiswa', 'MahasiswaController@index');
Route::get('/mahasiswa/add', 'MahasiswaController@add');
Route::get('/mahasiswa/{id}', 'MahasiswaController@show')->name('detailMahasiswa');
Route::get('/mahasiswa/edit/{id}', 'MahasiswaController@edit')->name('editMahasiswa');
Route::post('/mahasiswa/action_proses', 'MahasiswaController@action_proses');
Route::post('/mahasiswa/action_delete', 'MahasiswaController@action_delete');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
