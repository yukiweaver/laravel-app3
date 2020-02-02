<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReplyPostRequest;
use Log;
use App\ReplyPost;
use App\User;

class ReplyPostController extends Controller
{
  public function create(ReplyPostRequest $request)
  {
    $replyPost = new ReplyPost();
    $rContent = $request->input('m_content');
    $postId = $request->input('post_id');
    $ipAddress = User::find(request()->ip())->ip_address;
    $dbParams = [
      'post_id'           => $postId,
      'r_content'         => $rContent,
      'r_user_ip_address' => $ipAddress,
    ];
    try {
      $result = $replyPost->fill($dbParams)->save();
      if (!$result) {
        throw new Exception();
      }
    } catch (Exception $e) {
      return response()->json();
    }
    $replyPost = ReplyPost::findBylatest($ipAddress);
    // Log::debug($replyPost);
    return response()->json($replyPost);
  }
}
