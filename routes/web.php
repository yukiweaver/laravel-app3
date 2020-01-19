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
Route::get('/test', function() {
  // $crawler = Goutte::request('GET', 'https://shibuya.uplink.co.jp/movie');
  // // dd($crawler);
  //  $crawler->filter('/html/body/div[3]/section[1]/div[1]')->each(function ($node) {
  //    echo $node->text();
  //    echo '<br/>';
  //  });
  //  return view('welcome');
});
