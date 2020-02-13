<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyPostRequest;
use Log;
use App\ReplyPost;
use App\User;
use App\Notification;
use App\Post;
use Illuminate\Support\Facades\DB;

class ReplyPostController extends Controller
{
  public function create(ReplyPostRequest $request)
  {
    $replyPost = new ReplyPost();
    $notification = new Notification();
    $rContent = $request->input('m_content');
    $postId = $request->input('post_id');
    $ipAddress = User::find(request()->ip())->ip_address; // 返信したユーザ
    $post = Post::find($postId);
    $postUser = $post->user->ip_address; // 親投稿を投稿したユーザ
    $dbParams = [
      'post_id'           => $postId,
      'r_content'         => $rContent,
      'r_user_ip_address' => $ipAddress,
    ];
    $notifiDbParams = [
      'user_ip_address'   => $postUser,
    ];
    DB::beginTransaction();
    try {
      $replyPost->fill($dbParams)->save();
      $notification->fill($notifiDbParams)->save();
      DB::commit();
    } catch (Exception $e) {
      DB::rollback();
      return response()->json();
    }
    $replyPost = ReplyPost::findBylatest($ipAddress);
    return response()->json($replyPost);
  }
}
