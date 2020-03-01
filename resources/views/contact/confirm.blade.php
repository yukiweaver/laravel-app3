@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>お問い合わせ - 確認</h5>

          <form method="POST" action="{{ route('contact.send') }}">
            @csrf
        
            <div class="form-group">
              <label>メールアドレス：</label>
              <div>
                {{ $inputs['email'] }}
              </div>
              <input
                  name="email"
                  value="{{ $inputs['email'] }}"
                  type="hidden">
            </div>
        
            <div class="form-group">
              <label>タイトル：</label>
              <div>
                {{ $inputs['title'] }}
              </div>
              <input
                  name="title"
                  value="{{ $inputs['title'] }}"
                  type="hidden">
            </div>
        
        
            <div class="form-group">
            <label>お問い合わせ内容：</label>
            <div>
              {!! nl2br(e($inputs['body'])) !!}
            </div>
            <input
                name="body"
                value="{{ $inputs['body'] }}"
                type="hidden">
            </div>
        
            <button type="submit" name="action" value="back" class="btn btn-primary">
                入力内容修正
            </button>
            <button type="submit" name="action" value="submit" class="btn btn-primary">
                送信する
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')
@endsection