@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container" id="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card" id="card">
        <div class="card-body">
          <h5>お問い合わせ - 入力</h5>

          <form method="POST" action="{{ route('contact.confirm') }}">
            @csrf
            <div class="form-group">
              <label>メールアドレス</label>
              <input
                  name="email"
                  value="{{ old('email') }}"
                  type="text"
                  class="form-control">
              @if ($errors->has('email'))
                  <p class="error-message">{{ $errors->first('email') }}</p>
              @endif
            </div>
        
            <div class="form-group">
              <label>タイトル</label>
              <input
                  name="title"
                  value="{{ old('title') }}"
                  type="text"
                  class="form-control">
              @if ($errors->has('title'))
                  <p class="error-message">{{ $errors->first('title') }}</p>
              @endif
            </div>
        
        
            <div class="form-group">
              <label>お問い合わせ内容</label>
              <textarea name="body" class="form-control">{{ old('body') }}</textarea>
              @if ($errors->has('body'))
                  <p class="error-message">{{ $errors->first('body') }}</p>
              @endif
            </div>
        
            <button type="submit" class="btn btn-primary">
                入力内容確認
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@include('notification.index')
@endsection