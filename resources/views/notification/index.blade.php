<div class="container close" id="notification">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <h3>通知一覧</h3>
        <div class="card-body">
          <ul id="notification-list">
            <li>テスト</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php phpinfo(); ?>

<script>
  let container = document.getElementById('container');
  let notification = document.getElementById('notification');
  document.getElementById('humberger').onclick = function() {
    container.classList.toggle('close');
    notification.classList.toggle('close');
  }

  $(function() {
    $(function() {
      // setInterval(update, 5000);
    });

    function buildHtml(val) {
      let postId = val.post_id;
      let mContent = val.m_content;
      let html = `
        <li>投稿id${postId}に返信が届きました。</li>
        <button class="btn btn-primary">テスト</button>
      `;
      return html;
    }

    function update() {
      $.ajax({
        url: "{{route('n_index')}}",
        type: 'POST',
        dataType: 'json',
        data: {
          '_token': '{{csrf_token()}}'
        }
      }).done(function(data) {
        $('#notification-list > li').remove();
        $('#notification-list > button').remove();
        $.each(data, function(key, val) {
          console.log(val);
          html = buildHtml(val);
          $('#notification-list').append(html);
        })
      }).fail(function(data) {
        console.log('システムエラー');
      });
    }
  });
</script>