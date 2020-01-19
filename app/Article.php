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
  ];
}
