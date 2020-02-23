@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @if ($errors->any())
      <div class="errors">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card" id="card">
        <h3>ニュース：Top</h3>
        <div class="card-body">
          <ul class="msr_newslist01">
            <li>
              <a href="#">
              <div>
                <time datetime="2016-1-1">2016.01.01</time>
                <p class="cat01">cat01</p>
              </div>
              <p> テキストテキスト </p>
              </a>
            </li>
            <li>
              <a href="#">
              <div>
                <time datetime="2016-1-1">2016.01.01</time>
                <p class="cat02">cat02</p>
              </div>
              <p> テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト </p>
              </a>
            </li>
            <li>
              <a href="#">
              <div>
                <time datetime="2016-1-1">2016.01.01</time>
                <p class="cat01">cat01</p>
              </div>
              <p> テキストテキスト </p>
              </a>
            </li>
            <li>
              <a href="#">
              <div>
                <time datetime="2016-1-1">2016.01.01</time>
                <p class="cat02">cat02</p>
              </div>
              <p> テキストテキスト </p>
              </a>
            </li>
          </ul>
          <br>
          <nav>
            <ul id="menu">
              <li><a class="current" href="return false" id="domestic">国内</a></li>
              <li><a href="return false" id="world">国際</a></li>
              <li><a href="return false" id="business">経済</a></li>
              <li><a href="return false" id="entertainment">エンタメ</a></li>
              <li><a href="return false" id="sports">スポーツ</a></li>
              <li><a href="return false" id="it">IT</a></li>
              <li><a href="return false" id="science">科学</a></li>
              <li><a href="return false" id="local">地域</a></li>
            </ul>
          </nav>
          <br>
          <table class="table table-bordered table-striped table-condensed">
          @foreach ($articles as $val)
            <tbody>
              <tr>
                <td>
                  <img src="{{$val->image_url}}" alt="画像" width="65" height="65">
                  <a href={{route('detail', ['article_id' => $val->id])}}>{{$val->title}}</a>
                </td>
                <td>{{$val->date}}</td>
              </tr>
            </tbody>
          @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')

<script>
  let menu = document.getElementById('menu');
  menu.onclick = function() {
    alert('test');
  }
</script>
@endsection