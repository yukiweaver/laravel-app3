<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    'read_flg',
  ];
}
