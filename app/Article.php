<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  const MAX = 25;

  /**
   * 記事が持つ投稿データを取得
   */
  public function posts() {
    return $this->hasMany('App\Post', 'user_ip_address');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'title',
    'url',
    'a_content',
    'image_url',
    'date',
    'article_kbn',
  ];

  // タイトルをキーに記事を取得
  public static function findByTitle($title) {
    $article = self::where('title', $title)->get()->first();
    return $article;
  }

  // 最新25件の記事を取得
  public static function findLatest() {
    $articles = self::orderBy('date', 'DESC')->take(25)->get();
    return $articles;
  }

  // 記事の合計数を取得
  public static function countByArticleKbn($articleKbn) {
    $articlesCount = self::where('article_kbn', $articlekbn)->count();
    return $articlesCount;
  }

  public static function findArticles($articleKbn, $pageId, $max) {
    if (empty($pageId)) {
      $offset = 0;
    } else {
      $offset = ($pageId - 1) * $max;
    }
    $articles = self::where('article_kbn', $articleKbn)->offset($offset)->limit($max)->get();
    if (isEmpty($articles)) {
      return [];
    }
    return $articles;
  }
}
