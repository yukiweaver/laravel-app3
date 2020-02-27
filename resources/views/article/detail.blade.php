@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>ニュース：詳細</h5>
          <div class="" style="text-align: center;">
            <span>
              <img src="{{$article->image_url}}" width="400" height="350" alt="img"/>
              <h3 class="ttl">{{$article->title}}</h3>
              <p>{{$article->a_content}}</p>
              <p class="msr_btn12">
                <a href="{{$article->url}}" target="_blank">続きを記事提供元で読む</a>
              </p>
            </span>
          </div>
        </div>
        <div class="everyone-talk">
          <div class="head-4">
            <h4>みんなのトーク</h4>
            {{-- <div class="loader">Loading...</div> --}}
          </div>
          <div class="talk">
            @if ($posts === null)
              <p id="no-talk">トークはありません。</p>
            @else
              @foreach ($posts as $post)
              <div class="box" id="{{$post->id}}">
                <img src="https://arisago.com/official/wp-content/uploads/2017/08/o_face003.png" width="60px" height="60px">&ensp;
                <span class="post_no">{{$post->post_no}}</span>.&ensp;
                <span>{{$post->created_at->format('Y-m-d H:i')}}</span><br>
                <span>{{$post->m_content}}</span>
                <button class="btn btn-sm btn-primary reply-btn">返信する</button>
                @if (!$post->replyPosts->isEmpty())
                  <div class="reply-box">
                    <br>
                    <a href="" class="reply-link" id="reply-link">返信を表示する</a>
                    <div class="reply-posts {{$post->id}}">
                      @foreach ($post->replyPosts as $replyPost)
                      <img src="https://banpeace.com/wp-content/uploads/2019/07/0ae3602e24015055bb2733b9dfd01aa0.png" width="50px" height="50px">&ensp;
                      <span>{{$replyPost->created_at->format('Y-m-d H:i')}}</span><br>
                      <span>{{$replyPost->r_content}}</span><br>
                      @endforeach
                    </div>
                  </div>
                @endif
              </div>
              @endforeach
            @endif
          </div>
          <button id="footer-btn" class="btn btn-primary">この記事についてトークする</button>
          <div class="post">
            <form action="#" name="m_form" id="m_form" class="anime_test">
              @csrf
              <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
              <input type="hidden" name="post_id" id="post_id" value="">
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

@include('notification.index')

<script>
  let form        = document.getElementById('m_form');
  let footerBtn   = document.getElementById('footer-btn');
  let closeBtn    = document.getElementById('close-btn');
  let mContent    = document.getElementById('m_content');
  let boxes       = document.getElementsByClassName('box');
  let replyBoxes  = document.getElementsByClassName('reply-box');
  let replyPosts  = document.getElementsByClassName('reply-posts');

  form.style.display = 'none';

  // トークするボタンクリックで発火
  footerBtn.onclick = function() {
    form.style.display = '';
    mContent.placeholder = 'この記事にトークする';
    document.getElementById('post_id').value = '';
  }

  // 閉じるボタンクリックで発火
  closeBtn.onclick = function(event) {
    event.preventDefault(); // HTMLでの送信をキャンセル
    form.style.display = 'none';
  }

  // 返信ボタンクリックで発火
  for (let i=0; i<boxes.length; i++) {
    boxes[i].getElementsByTagName('button')[0].onclick = function() {
      form.style.display = '';
      mContent.placeholder = `>>${i+1} へ返信`;
      document.getElementById('post_id').value = boxes[i].id
    }
  }

  // 返信投稿：初期では非表示
  for (let z=0; z<replyPosts.length; z++) {
    replyPosts[z].hidden = true;
  }

  // 「返信を表示する」クリックで発火
  for (let x=0; x<replyBoxes.length; x++) {
    replyBoxes[x].querySelector('a#reply-link').onclick = function(event) {
      event.preventDefault(); // HTMLでの送信をキャンセル
      let replyBox = replyBoxes[x].getElementsByTagName('div')[0];
      if (replyBox.hidden == true) {
        replyBox.hidden = false;
        replyBoxes[x].querySelector('a#reply-link').innerHTML = '返信を非表示にする';
      } else {
        replyBox.hidden = true;
        replyBoxes[x].querySelector('a#reply-link').innerHTML = '返信を表示する';
      }
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
      post_id: {
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
      post_id: {
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
    let postId;
    let url;
    $('#b_submit').click(function(event) {
      // バリデーションチェック
      $('#m_form').validate(valid);
      if (!$('#m_form').valid()) {
        return false;
      }
      postId = $('#post_id').val();
      if (postId) {
        url = '/reply_post/create';
      } else {
        url = '/post/create';
      }
      event.preventDefault(); // HTMLでの送信をキャンセル
      $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: {
          'm_content': $('#m_content').val(),
          'article_id': $('#article_id').val(),
          'post_id': postId,
          '_token': '{{csrf_token()}}'
        }
      }).done(function(data) {
        // console.log(data);
        if ($.isEmptyObject(data)) {
          $('#m_content').val('');
          alert('投稿に失敗しました。');
          return;
        }
        let img         = '<img src="https://arisago.com/official/wp-content/uploads/2017/08/o_face003.png" width="60px" height="60px">';
        let replyImg    = '<img src="https://banpeace.com/wp-content/uploads/2019/07/0ae3602e24015055bb2733b9dfd01aa0.png" width="50px" height="50px">';
        let createdAt   = moment(data.created_at).format('YYYY-MM-DD HH:mm');
        let content     = data.m_content ? data.m_content : data.r_content;
        let nextPostNo  = $('.post_no:last').text() ? parseInt($('.post_no:last').text()) + 1 : 1;
        let postNo      = `<span class="post_no">${nextPostNo}</span>`;
        let button      = '<button class="btn btn-sm btn-primary reply-btn">返信する</button>';
        if (data.m_content) {
          if ($('#no-talk').length) {
            $('#no-talk').remove();
          }
          $('.talk').append(`<div class='box' id=${data.id}>${img}&ensp;${postNo}.&ensp;<span>${createdAt}</span><br><span>${content}</span>${button}</div>`);
        } else {
          if ($(`.${data.post_id}`).length) {
            $(`.${data.post_id}`).append(`${replyImg}&ensp;<span>${createdAt}</span><br><span>${content}</span><br>`);
          } else {
            $(`#${data.post_id}`).append(
              $(`<div class="reply-box">`)
              .append(`<br><a href="" class="reply-link" id="reply-link">返信を非表示にする</a>`)
              .append(
                $(`<div class="reply-posts ${data.post_id}">`)
                .append(`${replyImg}&ensp;<span>${createdAt}</span><br><span>${content}</span><br></div>`)
                .append('</div>')
              )
            )
          }
        }

        $('#m_content').val('');
        alert('投稿しました。');
        $('#m_form').css('display', 'none');

        let boxes = document.getElementsByClassName('box');
        for (let i=0; i<boxes.length; i++) {
          boxes[i].getElementsByTagName('button')[0].onclick = function() {
            form.style.display = '';
            mContent.placeholder = `>>${i+1} へ返信`;
            document.getElementById('post_id').value = boxes[i].id
          }
        }

        let replyBoxes  = document.getElementsByClassName('reply-box');
        for (let x=0; x<replyBoxes.length; x++) {
          replyBoxes[x].querySelector('a#reply-link').onclick = function(event) {
            event.preventDefault(); // HTMLでの送信をキャンセル
            let replyBox = replyBoxes[x].getElementsByTagName('div')[0];
            if (replyBox.hidden == true) {
              replyBox.hidden = false;
              replyBoxes[x].querySelector('a#reply-link').innerHTML = '返信を非表示にする';
            } else {
              replyBox.hidden = true;
              replyBoxes[x].querySelector('a#reply-link').innerHTML = '返信を表示する';
            }
          }
        }
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