<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Log;
use Carbon\Carbon;

class ReplyPost extends Model
{
  /**
   * 返信投稿データを所有する投稿データを取得
   */
  public function post()
  {
    return $this->belongsTo('App\Post');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'post_id',
    'r_user_ip_address',
    'r_content',
  ];

  /**
   * 自分の最新の返信投稿を一件取得
   */
  public static function findBylatest($ipAddress) {
    $replyPost = self::where('r_user_ip_address', $ipAddress)->latest()->first();
    if (empty($replyPost)) {
      return;
    }
    $replyPost->created_at = Carbon::parse($replyPost->created_at);
    $replyPost->updated_at = Carbon::parse($replyPost->updated_at);
    return $replyPost;
  }
}
