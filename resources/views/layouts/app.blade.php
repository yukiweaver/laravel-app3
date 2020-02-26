<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
  <title>@yield('title')</title>
  <link href="{{ url('/') }}/dist/css/vendor/bootstrap.min.css" rel="stylesheet"><!-- Loading Bootstrap -->
  <link href="{{ url('/') }}/dist/css/flat-ui.min.css" rel="stylesheet"><!-- Loading Flat UI -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
  {{-- <link href="{{ url('/') }}/css/starter-template.css" rel="stylesheet"><!--Bootstrap theme(Starter)--> --}}
 
  <link rel="shortcut icon" href="/dist/favicon.ico">
 
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="{{ url('/') }}/assets/js/jquery.validate.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
  <script>
    var OneSignal = window.OneSignal || [];
      OneSignal.push(function () {
        OneSignal.init({
            appId: "59d75005-2e14-4243-88c8-1facaa9dc788",
        });

        if("{{ Session::has('ip_address') }}") {
          //onesignalにIPアドレスをセット
          OneSignal.on('subscriptionChange', function (isSubscribed) {
              if (isSubscribed == true) {
                  OneSignal.setExternalUserId("{{ Session::get('ip_address') }}");
                  OneSignal.getExternalUserId().then(function (id) {
                  });
              } else if (isSubscribed == false) {
                  OneSignal.removeExternalUserId();
              }
          });
        }
      });
  </script>
</head>
<body>
  <header>
    <h1 class="headline">
      <a>エンタメトーク</a>
      <div id="humberger">
        <div></div>
        <div></div>
        <div></div>
      </div>
    </h1>
    <ul class="nav-list">
      <li class="nav-list-item">
        <a href="{{route('root')}}" style="color:#777">Top</a>
      </li>
      <li class="nav-list-item">
        <a href="{{route('description')}}" style="color:#777">About</a>
      </li>
      {{-- <li class="nav-list-item">Topic</li> --}}
    </ul>
  </header>

  <!-- フラッシュメッセージ -->
  @if (Session::has('flash_message'))
    <p class="bg-success">{!! Session::get('flash_message') !!}</p>
  @endif

  @if (Session::has('error_message'))
    <p class="bg-danger">{!! Session::get('error_message') !!}</p>
  @endif
  <div class="container">
    @yield('content')
  </div>

  <script src="{{ url('/') }}/dist/scripts/flat-ui.min.js"></script>
  
  <script src="{{ url('/') }}/assets/js/prettify.js"></script>
  <script src="{{ url('/') }}/assets/js/application.js"></script>

  <!-- footer -->
  <footer>
  	<p>© 2020 Created by Yuki Ueno.</p>
  </footer>

</body>
</html>