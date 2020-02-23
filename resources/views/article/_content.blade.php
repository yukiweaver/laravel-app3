<!--　記事表示 部分 -->
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