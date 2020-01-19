<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
  public function index() {
    $viewParams = [];
    return view('article.index', $viewParams);
  }
}
