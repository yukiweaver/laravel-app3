<div class="container close" id="notification">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <h3>通知一覧</h3>
        <div class="card-body">
          <div id="notification-list">
            <form action="#" id="notify-form">
              <p>
                <input type="checkbox" id="test1" name="notify[1][read_flg]"/>
                <label for="test1">Red</label>
              </p>
              <p>
                <input type="checkbox" id="test2" name="notify[2][read_flg]"/>
                <label for="test2">Yellow</label>
              </p>
              <p>
                <input type="checkbox" id="test3" name="notify[3][read_flg]"/>
                <label for="test3">Green</label>
              </p>
                <p>
                  <input type="checkbox" id="test4" name="notify[4][read_flg]"/>
                  <label for="test4">Brown</label>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  let container = document.getElementById('container');
  let notification = document.getElementById('notification');
  document.getElementById('humberger').onclick = function() {
    container.classList.toggle('close');
    notification.classList.toggle('close');
  }

  $(function() {
    $(function() {
      setInterval(update, 10000);
    });

    function buildHtml(val) {
      let postId = val.post_id;
      let mContent = val.m_content;
      let notifyId = val.id;
      let html = `
              <p>
                <input type="checkbox" id="check${notifyId}" name="notify[${notifyId}][read_flg]"/>
                <label for="check${notifyId}">投稿内容　${mContent}にコメントが届いています。</label>
              </p>
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
        $('#notify-form > p').remove();
        $.each(data, function(key, val) {
          console.log(val);
          html = buildHtml(val);
          $('#notify-form').append(html);
        })
      }).fail(function(data) {
        console.log('システムエラー');
      });
    }
  });
</script>