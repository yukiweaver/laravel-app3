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
        <div class="everyone-talk" style="width:800px">
          <div class="head-4">
            <h4>みんなのトーク</h4>
          </div>
          <div class="talk">
            @if ($posts === null)
              <p>トークはありません。</p>
            @else
              @foreach ($posts as $post)
              <p class="box" id="{{$post->id}}">
                <img src="/storage/face001.png" width="60px" height="60px">&ensp;
                <span class="post_no">{{$post->post_no}}</span>.&ensp;
                <span>{{$post->created_at->format('Y-m-d H:i')}}</span><br>
                <span>{{$post->m_content}}</span>
                <button class="btn btn-sm btn-primary reply-btn">返信する</button>
              </p>
              @endforeach
            @endif
          </div>
          <button id="footer-btn" class="btn btn-primary">この記事についてトークする</button>
          <div class="post">
            <form action="#" name="m_form" id="m_form" class="anime_test">
              @csrf
              <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
              <input type="hidden" name="reply_post_id" id="reply_post_id" value="">
              <div class="form-group">
                <label for="textarea1">トーク:</label>
                <button class="btn btn-sm btn-default" id="close-btn">閉じる</button>
                <br><span id="error_msg"></span>
                <textarea name="m_content" id="m_content" class="form-control" placeholder="この記事にトークする"></textarea>
                <input type="submit" value="投稿する" class="btn btn-primary" id="b_submit">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let form        = document.getElementById('m_form');
  let footerBtn   = document.getElementById('footer-btn');
  let closeBtn    = document.getElementById('close-btn');
  let mContent    = document.getElementById('m_content');
  let boxes       = document.getElementsByClassName('box');
  form.style.display = 'none';

  // トークするボタンクリックで発火
  footerBtn.onclick = function() {
    form.style.display = '';
    mContent.placeholder = 'この記事にトークする';
    document.getElementById('reply_post_id').value = '';
  }

  // 閉じるボタンクリックで発火
  closeBtn.onclick = function(event) {
    event.preventDefault(); // HTMLでの送信をキャンセル
    form.style.display = 'none';
  }

  // 返信ボタンクリックで発火
  for (let i=0; i<boxes.length; i++) {
    boxes[i].lastElementChild.onclick = function() {
      form.style.display = '';
      mContent.placeholder = `>>${i+1} へ返信`;
      document.getElementById('reply_post_id').value = boxes[i].id
    }
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

  let valid = {
    //検証ルール
    rules: {
      m_content: {
        required: true,
        maxlength: 200
      },
      article_id: {
        required: true,
        number: true
      },
      reply_post_id: {
        required: false,
        number: true
      },
    },
    //入力項目ごとのエラーメッセージ定義
    messages: {
      m_content: {
        required: 'トークを入力してください。',
        maxlength: '200文字以内で入力してください。'
      },
      article_id: {
        required: '記事IDの値を入力してください。',
        number: '記事IDの値が不正です。'
      },
      reply_post_id: {
        number: '投稿IDの値が不正です。'
      },
    },
    //エラーメッセージ出力箇所
    errorPlacement: function(error, element){
      error.appendTo($('#error_msg'));
    },
    debug: true
  }

  $(function() {
    $('#b_submit').click(function(event) {
      // バリデーションチェック
      $('#m_form').validate(valid);
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
          'article_id': $('#article_id').val(),
          'reply_post_id': $('#reply_post_id').val(),
          '_token': '{{csrf_token()}}'
        }
      }).done(function(data) {
        console.log(data);
        if ($.isEmptyObject(data)) {
          $('#m_content').val('');
          alert('投稿に失敗しました。');
          return;
        }
        let img         = '<img src="/storage/face001.png" width="60px" height="60px">';
        let createdAt   = moment(data.created_at).format('YYYY-MM-DD HH:mm');
        let content     = data.m_content;
        let nextPostNo  = parseInt($('.post_no:last').text()) + 1;
        let postNo      = `<span class="post_no">${nextPostNo}</span>`;
        let button      = '<button class="btn btn-sm btn-primary reply-btn">返信する</button>';
        $('.talk').append(`<p class='box' id=${data.id}>${img}&ensp;${postNo}.&ensp;<span>${createdAt}</span><br><span>${content}</span>${button}</p>`);
        $('#m_content').val('');
        alert('投稿しました。');
        $('#m_form').css('display', 'none');
        return;
      }).fail(function(data) {
        $('#m_content').val('');
        alert('システムエラー');
        $('#m_form').css('display', 'none');
      });
    });
  });
  
</script>
@endsection