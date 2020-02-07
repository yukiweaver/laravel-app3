<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Article;

class GetItemFeed extends Command
{
  const SCRAPE_URL = 'https://news.yahoo.co.jp/topics/entertainment';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getItems';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraping Yahoo! News';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
        $dbParams[$key]['created_at'] = Carbon::now();
        $dbParams[$key]['updated_at'] = Carbon::now();
      }
      // dd($goutte);
      // dd($params);
      // dd($dbParams);
      if (!empty($dbParams)) {
        DB::beginTransaction();
        try {
          $result = DB::table('articles')->insert($dbParams);
          if (!$result) {
            throw new Exception;
          }
          DB::commit();
        } catch (Exception $e) {
          DB::rollback();
          Log::error('DBエラーが発生');
          throw $e;
        }
      }
      $this->info('successfully');
    }
}
