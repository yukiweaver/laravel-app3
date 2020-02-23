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
              <li><a class="current" href="" id="domestic">国内</a></li>
              <li><a href="" id="world">国際</a></li>
              <li><a href="" id="business">経済</a></li>
              <li><a href="" id="entertainment">エンタメ</a></li>
              <li><a href="" id="sports">スポーツ</a></li>
              <li><a href="" id="it">IT</a></li>
              <li><a href="" id="science">科学</a></li>
              <li><a href="" id="local">地域</a></li>
            </ul>
          </nav>
          <br>
          <table class="table table-bordered table-striped table-condensed" id="article-table">
            @include('article._content')
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')

<script>
  let menu = document.getElementById('menu');
  menu.onclick = function(event) {
    let articleName = event.target.id;
    let pageId = '';
    $.ajax({
      type: 'POST',
      url: "{{route('index')}}",
      dataType: 'html',
      data: {
        'article_name': articleName,
        'page_id': pageId,
        '_token': '{{csrf_token()}}'
      }
    }).done(function(data) {
      console.log(data);
      document.getElementById('article-table').innerHTML = data;
    }).fail(function(data) {
      console.log(data);
    });
    return false;
  }
</script>
@endsection