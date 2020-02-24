<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Batch extends Model
{
  // アクセサ：created_atをフォーマット変換
  public function getTimeAttribute() {
    return Carbon::parse($this->created_at)->format('Y-m-d H:i');
  }

  public static function findMenu() {
    $menus = self::orderBy('created_at', 'DESC')->limit(4)->get();
    return $menus;
  }
}
