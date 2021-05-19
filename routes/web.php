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
    Route::resource('question', 'Admin\QuestionController')->except(['show', 'create', 'update', 'destroy']);
    // 問題一覧機能
    Route::get('list', 'Admin\QuestionController@list')->name('list');
    // 問題の新規投稿 URLをregisterにするためにresouceからcreateを除外
    Route::get('question/register', 'Admin\QuestionController@register')->name('question.register');
    // 問題登録確認画面の前にpostする。バリデーション用
    Route::post('question/post', 'Admin\QuestionController@post')->name('question.post');
    // 問題の登録確認
    Route::get('question/registerConfirm', 'Admin\QuestionController@registerConfirm')->name('question.registerConfirm');
    // 問題の編集確認
    Route::get('question/editConfirm', 'Admin\QuestionController@editConfirm')->name('question.editConfirm');
    // 問題登録確認画面の前にpostする。バリデーション用
    Route::post('question/editPost', 'Admin\QuestionController@editPost')->name('question.editPost');
    // 確認画面をはさむのでresoucesでのルーティングでは作成しない（Questionのオブジェクトを送らず、formの値を送るため）
    Route::post('question/update', 'Admin\QuestionController@update')->name('question.update');
    // 問題の削除確認
    Route::get('question/{id}/destroyConfirm', 'Admin\QuestionController@destroyConfirm')->name('question.destroyConfirm');
    // 問題の削除
    Route::post('question/destroy', 'Admin\QuestionController@destroy')->name('question.destroy');
});

// 一般userのみアクセス可能
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function(){
    Route::get('user', 'UsersController@index')->name('user');
});
