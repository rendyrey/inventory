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

//Dashboard
Route::get('/','DashboardController@index');
//untuk autentikasi
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('dashboard','DashboardController@index');

//Order Pekerjaan ke Pemotong Pola
Route::get('order_pola','OrderPekerjaanController@index');
Route::post('order_pola','OrderPekerjaanController@tambah');
Route::get('validate_order','OrderPekerjaanController@validate_order');

//gudang
Route::get('gudang','GudangController@index');
Route::post('gudang','GudangController@tambah');
