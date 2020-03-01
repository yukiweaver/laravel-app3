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
Route::post('/', 'ArticleController@index')->name('index');
Route::get('article/detail', 'ArticleController@detail')->name('detail');
Route::post('post/create', 'PostController@create')->name('p_create');
Route::post('reply_post/create', 'ReplyPostController@create')->name('r_create');
Route::post('notification/index', 'NotificationController@index')->name('n_index');
Route::post('notification/update', 'NotificationController@update')->name('n_update');
Route::get('/description', 'ArticleController@description')->name('description');
Route::get('/policy', 'ArticleController@policy')->name('policy');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');
Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');

