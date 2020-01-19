<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
