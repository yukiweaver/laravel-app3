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

Route::get('/', 'ArticleController@index')->name('root');
Route::get('article/detail', 'ArticleController@detail')->name('detail');
Route::post('post/create', 'PostController@create')->name('p_create');
Route::post('reply_post/create', 'ReplyPostController@create')->name('r_create');

