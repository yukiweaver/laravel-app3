<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
  public function create(PostRequest $request)
  {
    $arr = array('コメント保存したよ' => $request->input('m_content'));
    // dd($arr);
    echo json_encode($arr);
    // echo $arr;
  }
}
