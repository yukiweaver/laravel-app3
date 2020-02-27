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
        <h5>ニュース：Top</h5>
        <div class="card-body">
          <ul class="msr_newslist01">
            @foreach ($menus as $menu)
            <li>
              <a href="javascript:void(0)">
              <div>
                <time datetime="{{$menu->time}}">{{$menu->time}}</time>
                &emsp;<p class="cat01">cat01</p>
              </div>
              <p> ニュース記事を更新しました。 </p>
              </a>
            </li>
            @endforeach
          </ul>
          <br>
          <nav>
            <ul id="menu">
              <li><a class="current" href="" id="entertainment">エンタメ</a></li>
              <li><a href="" id="domestic">国内</a></li>
              <li><a href="" id="world">国際</a></li>
              <li><a href="" id="business">経済</a></li>
              <li><a href="" id="sports">スポーツ</a></li>
              <li><a href="" id="it">IT</a></li>
              <li><a href="" id="science">科学</a></li>
              <li><a href="" id="local">地域</a></li>
            </ul>
          </nav>
          <br>
          <div class="article-content" id="article-content">
            @include('article._content')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')

<script>
  let menu = document.getElementById('menu');
  let selectPage = document.getElementById('select-page');
  let articleContent = document.getElementById('article-content');

  menu.onclick = function(event) {
    let articleName = event.target.id;
    let pageId = '';
    let current = document.getElementsByClassName('current');
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
      // console.log(data);
      document.getElementById('article-content').innerHTML = data;
      document.getElementById('select-page').options[0].selected = true;
      document.getElementById('article-table').setAttribute('name', articleName);
      current[0].classList.remove('current');
      event.target.classList.add('current');
    }).fail(function(data) {
      console.log(data);
    });
    return false;
  }

  articleContent.onchange = function(event) {
    let articleName = document.getElementById('article-table').getAttribute('name');
    let pageId = document.getElementById('select-page').value;
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
      document.getElementById('article-content').innerHTML = data;
      document.getElementById('select-page').value = pageId;
      document.getElementById('article-table').setAttribute('name', articleName);
    }).fail(function(data) {
      console.log(data);
    });
  }
</script>
@endsection