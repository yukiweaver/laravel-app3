<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\User;
use App\Post;
use App\Article;
use Log;

class PostController extends Controller
{
  public function create(PostRequest $request)
  {
    $post = new Post();
    $mContent = $request->input('m_content');
    $articleId = $request->input('article_id');
    $ipAddress = User::find(request()->ip())->ip_address;
    $dbParams = [
      'article_id'        => $articleId,
      'm_content'         => $mContent,
      'user_ip_address'   => $ipAddress,
    ];
    try {
      $result = $post->fill($dbParams)->save();
      if (!$result) {
        throw new Exception();
      }
    } catch (Exception $e) {
      return response()->json();
    }

    $post = Post::findBylatest($ipAddress);
    return response()->json($post);

    // echo json_encode($arr);
    // echo $arr;
  }
}
