<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class ArticleController extends Controller
{
  /**
   * ホーム画面：エンタメニュース表示アクション
   */
  public function index(Request $request) {
    $ipAddress = request()->ip();
    $user = User::find($ipAddress);
    if (is_null($user)) {
      $user = new User();
      $user->ip_address = $ipAddress;
      $user->save();
    }
    $images = [];
    $urls   = [];
    $titles = [];
    $dates  = [];
    $params = [];
    $goutte = GoutteFacade::request('GET', 'https://news.yahoo.co.jp/topics/entertainment');
    // //画像のsrc部分を取得
    // $goutte->filter('.thumbnail > img')->each(function ($node) use (&$images) {
    //   $images[] = $node->attr('src');
    // });
    // // url部分を取得
    // $goutte->filter('li.newsFeed_item > a')->each(function ($node) use (&$urls) {
    //   $urls[] = $node->attr('href');
    // });
    // // タイトル部分を取得
    // $goutte->filter('.newsFeed_item_title')->each(function ($node) use (&$titles) {
    //   $titles[] = $node->text();
    // });
    // // 日付部分を取得
    // $goutte->filter('.newsFeed_item_date')->each(function ($node) use (&$dates) {
    //   $dates[] = $node->text();
    // });
    $goutte->filter('li.newsFeed_item')->each(function ($node) use (&$params) {
      $params[] = $node->attr('a.newsFeed_item_link > div.newsFeed_item_thumbnail > div.thumbnail.thumbnail-small > img > src');
    });
    // dd($goutte);
    // $params = [
    //   'images'  => $images,
    //   'urls'    => $urls,
    //   'titles'  => $titles,
    //   'dates'   => $dates,
    // ];
    dd($params);
    $viewParams = [];
    return view('article.index', $viewParams);
  }

  // private

  private function scrape($url) {
    $images = [];
    $goutte = GoutteFacade::request('GET', $url);

    //画像のsrc部分を取得
    $goutte->filter('.thumbnail > img')->each(function ($node) use (&$images) {
      $images[] = $node->attr('src');
    });

    // タイトル部分を取得
    // $goutte->filter('')
  }
}
