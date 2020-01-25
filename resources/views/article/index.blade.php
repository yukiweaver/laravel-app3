@extends('layouts.app')
@section('title', 'エンタメトーク')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <h3>エンタメニュース：Top</h3>
        <div class="card-body">
          <table class="table table-bordered table-striped table-condensed">
          @foreach ($articles as $val)
            <tbody>
              <tr>
                <td>
                  <img src={{$val['image_url']}} alt="画像" width="65" height="65">
                  <a href="#">{{$val['title']}}</a>
                </td>
                <td>{{$val['date']}}</td>
              </tr>
            </tbody>
          @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection