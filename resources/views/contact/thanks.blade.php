@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>お問い合わせ - 完了</h5>
          <p>{{ __('送信完了') }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')
@endsection