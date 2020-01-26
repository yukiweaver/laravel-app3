@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <h3>エンタメニュース：詳細</h3>
        <div class="card-body">
          <div class="msr_box01" style="text-align: center;">
            <span>
              <img src="{{$article->image_url}}" width="500" height="350" alt="img"/>
              <h3 class="ttl">{{$article->title}}</h3>
              <p>{{$article->a_content}}</p>
              <p class="msr_btn12">
                <a href="{{$article->url}}" target="_blank">続きを記事提供元で読む</a>
              </p>
            </span>
          </div>
        </div>
        <div class="head-4">
          <h4>みんなのトーク</h4>
        </div>
        <p class="box"> ほげほげ<br>テスト </p>
        <p class="box"> ほげほげ </p>
        <p class="box"> ほげほげ </p>
        <p class="box"> ほげほげ </p>
        <button id="footer-btn" class="btn btn-primary">この記事についてトークする</button>
        <div class="post">
        <form action="#" name="m_form" id="m_form" class="anime_test">
          @csrf
          <div class="form-group">
            <label for="textarea1">Textarea:</label>
            <button class="btn btn-sm btn-default" id="close-btn">閉じる</button>
            <textarea id="textarea1" class="form-control" placeholder="この記事にトークする"></textarea>
            <input type="submit" value="トーク" class="btn btn-primary" id="b_submit">
          </div>
        </form>
        </div>
        <br>
        <br>
        aa
        <br>
      </div>
    </div>
  </div>
</div>

<script>
  let form = document.getElementById('m_form');
  let footerBtn = document.getElementById('footer-btn');
  let closeBtn = document.getElementById('close-btn');
  form.style.display = 'none';

  footerBtn.onclick = function() {
    form.style.display = '';
  }

  closeBtn.onclick = function(event) {
    event.preventDefault(); // HTMLでの送信をキャンセル
    form.style.display = 'none';
  }
</script>
@endsection