@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>アプリケーションの説明</h5>
          <br>
          <ul>
            <li>
              このアプリを作った理由
              <p>
                ニュース記事にコメントができれば面白いのではと思い、作りました。<br>
                また、スクレイピング、JavaScript、jqueryの学習のアウトプットとしても活用しました。
              </p>
            </li>
            <br>
            <li>
              このアプリでできること
              <p>
                ニュース記事は毎朝9時に更新されます。
                ニュース記事を見ることができ、記事に対してコメントを書き込めます。<br>
                また、コメントに対して返信ができます。<br>
                自分のコメントに対して返信があった場合、通知一覧に表示されます。<br>
                通知一覧は自動更新しています。
              </p>
            </li>
            <br>
            <li>
              用いた技術
              <p>
                Laravel（6.10.1）<br>
                PHP（7.2.21）<br>
                MySQL（5.7.27）<br>
                JavaScript / jquery<br>
                Goutte<br>
                OneSignal API<br>
                Heroku
              </p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection