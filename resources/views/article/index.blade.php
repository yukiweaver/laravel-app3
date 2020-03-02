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
          <table border="0" cellpadding="0" cellspacing="0"><tr><td><div style="border:1px solid #95a5a6;border-radius:.75rem;background-color:#FFFFFF;width:504px;margin:0px;padding:5px;text-align:center;overflow:hidden;"><table><tr><td style="width:240px"><a href="https://hb.afl.rakuten.co.jp/hgc/1a9e5377.6b64c905.1a9e5378.41e67027/?pc=https%3A%2F%2Fitem.rakuten.co.jp%2Fsugarbiscuit%2Flgww-af1163%2F&link_type=picttext&ut=eyJwYWdlIjoiaXRlbSIsInR5cGUiOiJwaWN0dGV4dCIsInNpemUiOiIyNDB4MjQwIiwibmFtIjoxLCJuYW1wIjoicmlnaHQiLCJjb20iOjEsImNvbXAiOiJkb3duIiwicHJpY2UiOjEsImJvciI6MSwiY29sIjoxLCJiYnRuIjoxLCJwcm9kIjowfQ%3D%3D" target="_blank" rel="nofollow noopener noreferrer" style="word-wrap:break-word;"  ><img src="https://hbb.afl.rakuten.co.jp/hgb/1a9e5377.6b64c905.1a9e5378.41e67027/?me_id=1276410&item_id=10094491&m=https%3A%2F%2Fthumbnail.image.rakuten.co.jp%2F%400_mall%2Fsugarbiscuit%2Fcabinet%2F202002_1%2Flgww-af1163.jpg%3F_ex%3D80x80&pc=https%3A%2F%2Fthumbnail.image.rakuten.co.jp%2F%400_mall%2Fsugarbiscuit%2Fcabinet%2F202002_1%2Flgww-af1163.jpg%3F_ex%3D240x240&s=240x240&t=picttext" border="0" style="margin:2px" alt="[商品価格に関しましては、リンクが作成された時点と現時点で情報が変更されている場合がございます。]" title="[商品価格に関しましては、リンクが作成された時点と現時点で情報が変更されている場合がございます。]"></a></td><td style="vertical-align:top;width:248px;"><p style="font-size:12px;line-height:1.4em;text-align:left;margin:0px;padding:2px 6px;word-wrap:break-word"><a href="https://hb.afl.rakuten.co.jp/hgc/1a9e5377.6b64c905.1a9e5378.41e67027/?pc=https%3A%2F%2Fitem.rakuten.co.jp%2Fsugarbiscuit%2Flgww-af1163%2F&link_type=picttext&ut=eyJwYWdlIjoiaXRlbSIsInR5cGUiOiJwaWN0dGV4dCIsInNpemUiOiIyNDB4MjQwIiwibmFtIjoxLCJuYW1wIjoicmlnaHQiLCJjb20iOjEsImNvbXAiOiJkb3duIiwicHJpY2UiOjEsImJvciI6MSwiY29sIjoxLCJiYnRuIjoxLCJwcm9kIjowfQ%3D%3D" target="_blank" rel="nofollow noopener noreferrer" style="word-wrap:break-word;"  >【クーポン利用で2628円】デニム ロングシャツ シャツワンピ レディース 長袖 シャツ ロング ワンピース トップス 2020春夏新作 フリー 【lgww-af1163】【予約販売：4月10日入荷予定順次発送】宅込</a><br><span >価格：5255円（税込、送料無料)</span> <span style="color:#BBB">(2020/3/3時点)</span></p><div style="margin:10px;"><a href="https://hb.afl.rakuten.co.jp/hgc/1a9e5377.6b64c905.1a9e5378.41e67027/?pc=https%3A%2F%2Fitem.rakuten.co.jp%2Fsugarbiscuit%2Flgww-af1163%2F&link_type=picttext&ut=eyJwYWdlIjoiaXRlbSIsInR5cGUiOiJwaWN0dGV4dCIsInNpemUiOiIyNDB4MjQwIiwibmFtIjoxLCJuYW1wIjoicmlnaHQiLCJjb20iOjEsImNvbXAiOiJkb3duIiwicHJpY2UiOjEsImJvciI6MSwiY29sIjoxLCJiYnRuIjoxLCJwcm9kIjowfQ%3D%3D" target="_blank" rel="nofollow noopener noreferrer" style="word-wrap:break-word;"  ><img src="https://static.affiliate.rakuten.co.jp/makelink/rl.svg" style="float:left;max-height:27px;width:auto;margin-top:0"></a><a href="https://hb.afl.rakuten.co.jp/hgc/1a9e5377.6b64c905.1a9e5378.41e67027/?pc=https%3A%2F%2Fitem.rakuten.co.jp%2Fsugarbiscuit%2Flgww-af1163%2F%3Fscid%3Daf_pc_bbtn&m=%3Fscid%3Daf_pc_bbtn&link_type=picttext&ut=eyJwYWdlIjoiaXRlbSIsInR5cGUiOiJwaWN0dGV4dCIsInNpemUiOiIyNDB4MjQwIiwibmFtIjoxLCJuYW1wIjoicmlnaHQiLCJjb20iOjEsImNvbXAiOiJkb3duIiwicHJpY2UiOjEsImJvciI6MSwiY29sIjoxLCJiYnRuIjoxLCJwcm9kIjowfQ==" target="_blank" rel="nofollow noopener noreferrer" style="word-wrap:break-word;"  ><div style="float:right;width:41%;height:27px;background-color:#bf0000;color:#fff !important;font-size:12px;font-weight:500;line-height:27px;margin-left:1px;padding: 0 12px;border-radius:16px;cursor:pointer;text-align:center;">楽天で購入</div></a></div></td><tr></table></div><br><p style="color:#000000;font-size:12px;line-height:1.4em;margin:5px;word-wrap:break-word"></p></td></tr></table>          <br>
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