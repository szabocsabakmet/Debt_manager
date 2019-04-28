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
    return redirect('/debts/home');
});

Route::get('debts/{id}/complete', 'DebtsController@complete');
Route::get('debts/archive', 'DebtsController@archive');
Route::get('debts/home', 'DebtsController@debtsHome');


Route::resource('debts', 'DebtsController');

Auth::routes();
