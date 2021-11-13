<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix("clients")->group(function() {
    Route::get('', 'ClientController@index')->name('client.index');
    Route::get('create', 'ClientController@create')->name('client.create');

    Route::post('store', 'ClientController@store')->name('client.store');
    Route::post('destroy/{client}', 'ClientController@destroy')->name('client.destroy');

    Route::get('validationcreate', 'ClientController@validationcreate')->name('client.validationcreate');
    Route::post('validationstore', 'ClientController@validationstore')->name('client.validationstore');

});
