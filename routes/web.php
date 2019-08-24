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

    // 文章分类相关操作
    Route::resource('category','CategoryController');
    //ajax排序
    Route::post('cate/order', 'CategoryController@changeOrder');

    // 文章相关操作
    Route::resource('article','ArticlesController');

    //文件上传
    Route::post('files','CommonController@fileUpload');

    // 友情链接
    Route::resource('links','LinksController');
    Route::post('links/order','LinksController@changeOrder');

    // 导航
    Route::resource('navs', 'NavsController');
    Route::post('navs/order','NavsController@changeOrder');

    //网站配置
    Route::resource('configs','ConfigsController');
    Route::post('configs/order','ConfigsController@changeOrder');
    Route::post('configs/changeContent','ConfigsController@changeContent');
    Route::get('changes','ConfigsController@changeConfigs');


});



