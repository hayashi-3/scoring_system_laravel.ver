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

// 権限でアクセスを振り分けるため、デフォルトのルートは使わない
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// ログイン・ログアウトは全ユーザー可能
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// adminのみアクセス可能
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'can:admin']], function(){
    Route::resource('user', 'AdminController')->except(['show']);
});

// 一般userのみアクセス可能
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function(){
    Route::get('user', 'UsersController@index')->name('user');
});
