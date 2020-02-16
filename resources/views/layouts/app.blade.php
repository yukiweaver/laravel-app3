<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    // var OneSignal = window.OneSignal || [];
    // OneSignal.push(function() {
    //   OneSignal.init({
    //     appId: "59d75005-2e14-4243-88c8-1facaa9dc788",
    //     autoRegister: false,
    //     notifyButton: {
    //       enable: true /* Set to false to hide */
    //     }
    //   });
    // });
    // OneSignal.push(['sendTag', 'customId', 1, function(tagsSent) {}]); // ここ追加
    var OneSignal = window.OneSignal || [];
        OneSignal.push(function () {
          OneSignal.init({
              appId: "59d75005-2e14-4243-88c8-1facaa9dc788",
          });

          // if(isset($loginUser)) {
            //onesignalにuser_idをセット
            OneSignal.on('subscriptionChange', function (isSubscribed) {
                if (isSubscribed == true) {
                    OneSignal.setExternalUserId('172.19.0.1');
                    OneSignal.getExternalUserId().then(function (id) {
                    });
                } else if (isSubscribed == false) {
                    OneSignal.removeExternalUserId();
                }
            });
          // }
        });
  </script>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href={{route('root')}}>エンタメトーク</a>
        <div id="humberger">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
      <div id="navbar" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <?php if(preg_match("/starter/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/flat_ui/starter">Home</a></li>
          <?php if(preg_match("/components/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/flat_ui/components">Components</a></li>
          <?php if(preg_match("/typo/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/flat_ui/typo">Typography</a></li>
          <?php if(preg_match("/forms/",$_SERVER["REQUEST_URI"])){ echo "<li class='active'>"; }else{ echo "<li>"; } ?><a href="{{ url('/') }}/flat_ui/forms">forms</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>

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

</body>
</html>