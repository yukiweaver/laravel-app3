@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>広告について</h5>
          <p>
            当サイトはGoogle及びGoogleのパートナー（第三者配信事業者）の提供する広告を設置しております。<br>
            その広告配信にはCookieを使用し、当サイトへの過去のアクセス情報に基づいて広告を配信します。<br>
            <a href="https://support.google.com/ds/answer/2839090?hl=ja&amp;ref_topic=2473095" target="_blank">検索広告360</a>を使用することにより、GoogleやGoogleのパートナーは当サイトや他のサイトへのアクセス情報に基づいて、適切な広告を当サイト上でお客様に表示できます。<br>
            お客様は<a href="https://www.google.com/settings/u/0/ads/authenticated?hl=ja" target="_blank">Googleアカウントの広告設定ページ</a>で、インタレストベースでの広告掲載に使用される検索広告360を無効にできます。<br>
            また、<a href="http://aboutads.info" target="_blank">aboutads.info</a>のページにアクセスして頂き、インタレストベースでの広告掲載に使用される第三者配信事業者のCookieを無効にできます。<br>
            その他、Googleの広告におけるCookieの取り扱い詳細については、<a href="http://www.google.co.jp/policies/technologies/ads/" target="_blank">Googleのポリシーと規約ページ</a>をご覧ください。
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')
@endsection