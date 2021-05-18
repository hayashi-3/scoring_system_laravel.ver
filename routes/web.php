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
    // ユーザーのshow以外
    Route::resource('user', 'AdminController')->except(['show']);
    // ユーザー一覧機能
    Route::get('userList', 'AdminController@userList')->name('userList');
    // 問題のshow以外
    Route::resource('question', 'Admin\QuestionController')->except(['show', 'create']);
    // 問題一覧機能
    Route::get('list', 'Admin\QuestionController@list')->name('list');
    // 問題の新規投稿 URLをregisterにするためにresouceはからcreateを除外
    Route::get('question/register', 'Admin\QuestionController@register')->name('question.register');
    // 問題登録確認画面の前にpostする
    Route::post('question/post', 'Admin\QuestionController@post')->name('question.post');
    // 問題の登録確認
    Route::get('question/registerConfirm', 'Admin\QuestionController@registerConfirm')->name('question.registerConfirm');
});

// 一般userのみアクセス可能
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function(){
    Route::get('user', 'UsersController@index')->name('user');
});
