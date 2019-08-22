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

Route::get('/test', 'Home\IndexController@index');

Route::get('/', function () {
    return view('welcome');
});

/**
 * 后台路由
 */

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('login', 'LoginController@login');
    Route::post('login/handle', 'LoginController@handleLogin')->name('doLogin');
});

Route::prefix('admin')->namespace('Admin')->middleware('check')->group(function() {
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('logout','LoginController@logout');
    Route::get('pass','AdminController@change');
    Route::post('change','AdminController@edits');
});



