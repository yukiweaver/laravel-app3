<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Article;
use App\Post;
use App\Batch;
use Weidner\Goutte\GoutteFacade as GoutteFacade;
// use Guzzle\Http\Client as GuzzleClient;
use GuzzleHttp\Client as GuzzleClient;
use Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
  const SCRAPE_ENTAME_URL     = 'https://news.yahoo.co.jp/topics/entertainment';
  const SCRAPE_TOP_URL        = 'https://news.yahoo.co.jp/topics/top-picks';
  const SCRAPE_DOMESTIC_URL   = 'https://news.yahoo.co.jp/topics/domestic';
  const SCRAPE_WORLD_URL      = 'https://news.yahoo.co.jp/topics/world';
  const SCRAPE_BUSINESS_URL   = 'https://news.yahoo.co.jp/topics/business';
  const SCRAPE_SPORTS_URL     = 'https://news.yahoo.co.jp/topics/sports';
  const SCRAPE_IT_URL         = 'https://news.yahoo.co.jp/topics/it';
  const SCRAPE_SCIENCE_URL    = 'https://news.yahoo.co.jp/topics/science';
  const SCRAPE_LOCAL_URL      = 'https://news.yahoo.co.jp/topics/local';

  const MAX = 25;
  const ENTAME_ARTICLE_KBN = '5';

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

    // $this->scrape();
    if ($request->isMethod('post')) {
      $articleName = $request->input('article_name');
      $pageId = $request->input('page_id');
      $articleKbn = getArticleKbn($articleName);
      $count = Article::countByArticleKbn($articleKbn);
      $articles = Article::findArticles($articleKbn, $pageId, self::MAX);
      $total = Article::gettotalPage($count, self::MAX);
      $totalPages = $this->totalPages($total);
      $viewParams = [
        'articles' => $articles,
        'totalPages'   => $totalPages,
      ];
      return view('article._content', $viewParams);
    }

    // 初期はエンタメを表示
    $pageId = '';
    $articles = Article::findArticles(self::ENTAME_ARTICLE_KBN, $pageId, self::MAX);
    $count = Article::countByArticleKbn(self::ENTAME_ARTICLE_KBN);
    $total = Article::gettotalPage($count, self::MAX);
    $totalPages = $this->totalPages($total);

    // メニューは4件まで表示
    $menus = Batch::findMenu();

    $viewParams = [
      'articles'    => $articles,
      'totalPages'  => $totalPages,
      'menus'       => $menus,
    ];
    return view('article.index', $viewParams);
  }

  /**
   * ニュース詳細表示アクション
   */
  public function detail(ArticleRequest $request)
  {
    $articleId = $request->input('article_id');
    $data = ['article_id' => $articleId];
    // クエリパラメータチェック
    $validator = $this->validator($data);
    if ($validator->fails()) {
      return redirect(route('root'))->withErrors($validator)->withInput();
    }
    $article = Article::find($articleId);
    $posts = Post::findByArticleId($articleId);
    $viewParams = [
      'article' => $article,
      'posts'   => $posts,
    ];
    return view('article.detail', $viewParams);
  }

  /**
   * 説明表示アクション
   */
  public function description()
  {
    $viewParams = [];
    return view('article.description', $viewParams);
  }
  /**
   * プライバシーポリシー表示アクション
   */
  public function policy()
  {
    $viewParams = [];
    return view('article.policy', $viewParams);
  }



  // private

  private function scrape() {
    $i = 0;
    $params = [];
    $scrapeUrls = [
      self::SCRAPE_DOMESTIC_URL,
      self::SCRAPE_WORLD_URL,
      self::SCRAPE_BUSINESS_URL,
      self::SCRAPE_ENTAME_URL,
      // self::SCRAPE_SPORTS_URL,
      // self::SCRAPE_IT_URL,
      // self::SCRAPE_SCIENCE_URL,
      // self::SCRAPE_LOCAL_URL,
    ];
    $client = new \Goutte\Client();
    foreach ($scrapeUrls as $url) {
      $goutte = $client->request('GET', $url);
      $goutte->filter('li.newsFeed_item')->each(function ($node) use (&$params, &$i, &$client, &$goutte, &$url) {
        if (count($node->filter('.newsFeed_item_link')) > 0) {
          $client->click($node->filter('a')->link())->filter('.pickupMain_inner')->each(function($n) use (&$params, &$i) {
            $params[$i]['a_content'] = $n->filter('.pickupMain_articleSummary')->text();
            $params[$i]['url'] = $n->filter('.pickupMain_detailLink > a')->attr('href');
          });
          $client->click($node->filter('a')->link())->filter('.tpcNews_body')->each(function($n) use (&$params, &$i) {
            $params[$i]['a_content'] = $n->filter('.tpcNews_summary')->text();
            $params[$i]['url'] = $n->filter('.tpcNews_detailLink > a')->attr('href');
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
          if ($url == self::SCRAPE_DOMESTIC_URL)  $params[$i]['article_kbn'] = '2';
          if ($url == self::SCRAPE_WORLD_URL)     $params[$i]['article_kbn'] = '3';
          if ($url == self::SCRAPE_BUSINESS_URL)  $params[$i]['article_kbn'] = '4';
          if ($url == self::SCRAPE_ENTAME_URL)    $params[$i]['article_kbn'] = '5';
          if ($url == self::SCRAPE_SPORTS_URL)    $params[$i]['article_kbn'] = '6';
          if ($url == self::SCRAPE_IT_URL)        $params[$i]['article_kbn'] = '7';
          if ($url == self::SCRAPE_SCIENCE_URL)   $params[$i]['article_kbn'] = '8';
          if ($url == self::SCRAPE_LOCAL_URL)     $params[$i]['article_kbn'] = '9';
        }

        $i ++;
      });
    }
    // dd($params);
    $dbParams = [];
    foreach ($params as $key => $val) {
      $article = Article::findByTitle($val['title']);
      if (!empty($article)) {
        continue;
      }
      $dbParams[$key]['a_content']    = $val['a_content'];
      $dbParams[$key]['url']          = $val['url'];
      $dbParams[$key]['image_url']    = $val['image_url'];
      $dbParams[$key]['title']        = $val['title'];
      $dbParams[$key]['date']         = $val['date'];
      $dbParams[$key]['article_kbn']  = $val['article_kbn'];
      $dbParams[$key]['created_at']   = Carbon::now();
      $dbParams[$key]['updated_at']   = Carbon::now();
    }
    $batchDbParams = [
      'created_at' => Carbon::now(),
      'updated_at' => Carbon::now(),
    ];
    // dd($goutte);
    // dd($params);
    // dd($dbParams);
    if (!empty($dbParams)) {
      DB::beginTransaction();
      try {
        $result = DB::table('articles')->insert($dbParams);
        $batchResult = DB::table('batches')->insert($batchDbParams);
        if (!$result || $batchResult) {
          throw new Exception;
        }
        DB::commit();
      } catch (Exception $e) {
        DB::rollback();
        Log::error('DBエラーが発生');
        throw $e;
      }
    }
  }

  private function validator($data) {
    $validator = Validator::make($data, [
      'article_id' => 'required|numeric',
    ]);
    return $validator;
  }

  // 合計ページ数から配列を返す
  private function totalPages($total) {
    $totalPages = [];
    if (isset($total)) {
      for ($i=1; $i<=$total; $i++) {
        array_push($totalPages, $i);
      }
    }
    return $totalPages;
  }
}
