<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
  /**
   * 投稿データを所有するユーザー取得
   */
  public function user()
  {
    return $this->belongsTo('App\User', 'ip_address');
  }

  /**
   * 投稿データを所有する記事を取得
   */
  public function article()
  {
    return $this->belongsTo('App\Article');
  }

  /**
   * 投稿データの返信投稿データを取得
   */
  public function replyPosts() {
    return $this->hasMany('App\ReplyPost');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'article_id',
    'user_ip_address',
    'm_content',
    'reply_post_id',
  ];

  /**
   * 記事IDをキーにして投稿データを取得
   */
  public static function findByArticleId($articleId) {
    $posts = self::where('article_id', $articleId)->orderBy('created_at', 'ASC')->get();
    if ($posts->isEmpty()) {
      return;
    }
    $i = 0;
    foreach ($posts as $post) {
      $i ++;
      $post->post_no = $i;
      $post->created_at = Carbon::parse($post->created_at);
      $post->updated_at = Carbon::parse($post->updated_at);
    }
    return $posts;
  }

  /**
   * 自分の最新の投稿を一件取得
   */
  public static function findBylatest($ipAddress) {
    $post = self::where('user_ip_address', $ipAddress)->latest()->first();
    if (empty($post)) {
      return;
    }
    $post->created_at = Carbon::parse($post->created_at);
    $post->updated_at = Carbon::parse($post->updated_at);
    return $post;
  }
}
