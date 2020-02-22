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
              <p>
                <input type="submit" id="notify-submit" class="btn btn-primary" value="既読をつける">
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
      setInterval(update, 15000);
    });

    function buildHtml(data) {
      let html = '';
      if (!($.isEmptyObject(data))) {
        $.each(data, function(key, val) {
          let postId = val.post_id;
          let mContent = val.m_content;
          let notifyId = val.id;
          html += `
          <p id="check${notifyId}">
            <input type="checkbox" class="check_read_flg" id="${notifyId}" name="notify[${notifyId}][read_flg]"/>
            <label for="${notifyId}">投稿内容　${mContent} にコメントが届いています。（id: ${postId}）</label>
          </p>
          `
        });
        html += `<p><button id="notify-submit" class="btn btn-primary" onclick="notifyUpdate();">既読をつける</button></p>`;
      }
      
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
        $('#notify-form').remove();
        html = buildHtml(data);
        $('#notification-list').html(html);
      }).fail(function(data) {
        console.log('システムエラー');
      });
    }
  });

  function notifyUpdate() {
    let notifyIds = [];
    $.each($('.check_read_flg'), function(key, val) {
      if ($(this).prop('checked')) {
        id = $(this).attr('id');
        notifyIds.push(id);
      }
    });

    $.ajax({
      url: "{{route('n_update')}}",
      type: 'POST',
      dataType: 'json',
      data: {
        'notifyIds': notifyIds,
        '_token': '{{csrf_token()}}'
      }
    }).done(function(data) {
      console.log(data);
      if (data.status == 'ng') {
        alert(data.content.error);
        return;
      }
      for (let i=0; i<data.content.length; i++) {
        checkTag = '#check' + data.content[i];
        $(checkTag).remove();
      }
      alert('通知を既読に更新しました。');
      return;
    }).fail(function(data) {
      alert('ステータスコード：' + data.status + '\n' + data.responseText);
      console.log(data);
      console.log('システムエラー');
    });
  }
</script>