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


Route::group(['prefix' => 'admin'],function(){
    Route::group(['prefix' => 'staffs'],function(){
        Route::get('/','AdministratorController@staffs');
        Route::post('/create','AdministratorController@createStaff');

    });

    Route::group(['prefix' => 'customers'],function(){
        Route::get('/','AdministratorController@customers');
        Route::post('/create','AdministratorController@createCustomer');

    });

    Route::group(['prefix' => 'rooms'],function(){
        Route::get('/','AdministratorController@rooms');
    });


    Route::group(['prefix' => 'reservations'],function(){
        Route::get('/','AdministratorController@reservations');
        Route::post('/create','AdministratorController@reservationsCreate');

    });
});

