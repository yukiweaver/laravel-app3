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
              <label for="textarea1">トーク:</label>
              <button class="btn btn-sm btn-default" id="close-btn">閉じる</button>
              <textarea name="m_content" id="m_content" class="form-control" placeholder="この記事にトークする"></textarea>
              {{-- <input name="m_content" id="m_content" class="form-control"> --}}
              <input type="submit" value="投稿する" class="btn btn-primary" id="b_submit">
            </div>
          </form>
        </div>
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

  // fetch API使ってみたサンプル

  // function post(event) {
  //   event.preventDefault(); // HTMLでの送信をキャンセル
  //   fetch('/post/create', {
  //     method: 'POST',
  //     body: new FormData(form)
  //   })
  //   .then(function(response) {
  //     return response.json()
  //   })
  //   .then(function(json) {
  //     console.log(json);// Object {コメント保存したよ: "テスト"}
  //   })
  // }

  $('#m_form').validate({
    //検証ルール
    rules: {
      m_content: {
        required: true,
        minlength: 5
      }
    },
    //入力項目ごとのエラーメッセージ定義
    messages: {
      name: {
        required: 'トークを入力してください',
        minlength: '5文字以上で入力してください'
      }
    },

    //エラーメッセージ出力箇所
    errorPlacement: function(error, element){
      error.insertAfter(element);
    },
    debug: true
  });

  let valid = {
    //検証ルール
    rules: {
      m_content: {
        required: true,
        minlength: 5
      }
    },
    //入力項目ごとのエラーメッセージ定義
    messages: {
      name: {
        required: 'トークを入力してください',
        minlength: '5文字以上で入力してください'
      }
    }
  }

  $(function() {
    $('#b_submit').click(function(event) {
      $('#m_form').validate(valid);
      // 失敗で戻る
      if (!$('#m_form').valid()) {
        return false;
      }
      event.preventDefault(); // HTMLでの送信をキャンセル
      $.ajax({
        type: 'POST',
        url: '/post/create',
        dataType: 'json',
        data: {
          'm_content': $('#m_content').val(),
          '_token': '{{csrf_token()}}'
        }
      }).done(function(data) {
        console.log(data);
      }).fail(function(data) {
        alert('システムエラー');
      });
    });
  });
  
</script>
@endsection