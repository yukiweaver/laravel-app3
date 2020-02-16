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
  /**
   * 返信アクション
   */
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
      'post_id'           => $postId,
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
    $this->sendPushNotify($postUser);
    $replyPost = ReplyPost::findBylatest($ipAddress);
    // $replyPost->user_ip_address = $postUser;
    return response()->json($replyPost);
  }


  private function sendPushNotify($ipAddr)
  {
    $fields = array(
      'app_id' => "59d75005-2e14-4243-88c8-1facaa9dc788",
      'include_external_user_ids' => ['172.19.0.1'],
      'url' => url('/'),
      // 'tags' => array(array("key" => "customId", "relation" => "=", "value" => "1")),
      'headings' => array('en' => 'It will be announced', 'ja' => 'お知らせです'),
      'contents' => array('en' => 'Your comment has arrived!', 'ja' => 'あなたの投稿にコメントが届きました')
    );

    $fields = json_encode($fields);
    Log::debug($fields);

    $ch = curl_init();
    Log::debug(false);
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER,
                array('Content-Type: application/json; charset=utf-8', 'Authorization: Basic OTRlOGFiM2ItOWFlMS00NWU1LWFjOWQtNTM0ZjlhODE4YmVh'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    // Log::debug($ch);
    Log::debug($response);
    curl_close($ch);
  }
}
