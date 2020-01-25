<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
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
  ];

  // タイトルをキーに記事を取得
  public static function findByTitle($title) {
    $article = self::where('title', $title)->get()->first();
    return $article;
  }

  // 最新25件の記事を取得
  public static function findLatest() {
    $articles = self::orderBy('id', 'ASC')->take(25)->get();
    return $articles;
  }
}
