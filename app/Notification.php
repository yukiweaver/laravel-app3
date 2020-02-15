<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{
  /**
   * 投稿データを所有するユーザー取得
   */
  public function user()
  {
    return $this->belongsTo('App\User', 'ip_address');
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_ip_address',
    'post_id',
    'read_flg',
  ];

  // 未読の通知を取得
  public static function findByIpAddr($ipAddr) {
    $notifications = self::from('notifications as n')
                     ->join('posts as p', 'n.post_id', '=', 'p.id')
                     ->where('n.user_ip_address', $ipAddr)
                     ->where('n.read_flg', false)
                     ->get(['n.*', 'p.m_content']);
    if ($notifications->isEmpty()) {
      return [];
    }
    return $notifications;
  }
}
