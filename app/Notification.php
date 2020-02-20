<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

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

  /**
   * 未読の通知データを取得
   * @return collection
   */
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

  /**
   * 主キーから通知データを取得
   * @return collection
   */
  public static function findByIds($notifyIds) {
    $notifications = self::whereIn('id', $notifyIds)->get();
    if ($notifications->isEmpty()) {
      return [];
    }
    return $notifications;
  }

  /**
   * 通知を既読へupdate
   */
  public static function notifyUpdate($dbParams, $notifyIds) {
    // $notifications = self::findByIds($notifyIds);
    // if ($notifications->isEmpty()) {
    //   return [];
    // }
    DB::beginTransaction();
    try {
      $result = self::whereIn('id', $notifyIds)->update($dbParams);
      if (!$result) {
        throw new Exception('通知の更新処理に失敗しました。');
      }
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      return ['error' => $e->getMessage()];
    }
  }
}
