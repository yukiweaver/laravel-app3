<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use Weidner\Goutte\GoutteFacade as GoutteFacade;

class ArticleController extends Controller
{
  const SCRAPE_URL = 'https://news.yahoo.co.jp/topics/entertainment';

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

    $i = 0;
    $params = [];
    $client = new \Goutte\Client();
    $goutte = $client->request('GET', self::SCRAPE_URL);
    $goutte->filter('li.newsFeed_item')->each(function ($node) use (&$params, &$i, &$client, &$goutte) {
      if (count($node->filter('.newsFeed_item_link')) > 0) {
        $client->click($node->filter('a')->link())->filter('.pickupMain_inner')->each(function($n) use (&$params, &$i) {
          $params[$i]['a_content'] = $n->filter('.pickupMain_articleSummary')->text();
          $params[$i]['url'] = $n->filter('.pickupMain_detailLink > a')->attr('href');
        });
      }
      if (count($node->filter('.thumbnail > img')) > 0) {
        $params[$i]['image_url'] = $node->filter('.thumbnail > img')->attr('src');
      }
      if (count($node->filter('.newsFeed_item_title')) > 0) {
        $params[$i]['title'] = $node->filter('.newsFeed_item_title')->text();
      }
      if (count($node->filter('.newsFeed_item_date')) > 0) {
        $params[$i]['date'] = $node->filter('.newsFeed_item_date')->text();
      }
      $i ++;
    });
    $dbParams = [];
    foreach ($params as $key => $val) {
      $article = Article::findByTitle($val['title']);
      if (!empty($article)) {
        continue;
      }
      $dbParams[$key]['a_content']  = $val['a_content'];
      $dbParams[$key]['url']        = $val['url'];
      $dbParams[$key]['image_url']  = $val['image_url'];
      $dbParams[$key]['title']      = $val['title'];
      $dbParams[$key]['date']       = $val['date'];
    }
    // dd($goutte);
    // dd($params);
    // dd($dbParams);
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
