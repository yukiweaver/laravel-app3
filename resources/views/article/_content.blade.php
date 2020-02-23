<!--　記事表示 部分 -->
<div class="cp_ipselect cp_sl01">
  <select id="select-page">
    @foreach ($totalPages as $page)
    <option value="{{$page}}">{{$page}}</option>
    @endforeach
  </select>
  <label for="select-page">ページ目を表示</label>
</div>
<table class="table table-bordered table-striped table-condensed" name="entertainment" id="article-table">
  <tbody>
    @foreach ($articles as $val)
    <tr>
      <td>
        <img src="{{$val->image_url}}" alt="画像" width="65" height="65">
        <a href={{route('detail', ['article_id' => $val->id])}}>{{$val->title}}</a>
      </td>
      <td>{{$val->date}}</td>
    </tr>
    @endforeach
  </tbody>
</table>