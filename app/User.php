<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 主キーをオーバーライド
    protected $primaryKey = 'ip_address';

    // IDを自動増分しない場合
    public $incrementing = false;

    // 主キーが整数でない場合
    protected $keyType = 'string';

    /**
     * ユーザーの投稿データを取得
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
        'ip_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
