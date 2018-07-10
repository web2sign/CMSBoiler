<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('page_title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" />
  <link rel="stylesheet" href="{{url('media/css/bootstrap.min.css')}}" />
  <link rel="stylesheet" href="{{url('media/sweetalert/sweetalert.css')}}" />
  <link rel="stylesheet" href="{{url('media/css/AdminLTE.min.css')}}" />
  <link rel="stylesheet" href="{{url('media/css/skins/_all-skins.min.css')}}" />
  @yield('styles')
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="@yield('body_class')">
@yield('body')

<script src="{{url('media/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{url('media/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{url('media/js/bootstrap.min.js')}}"></script>@yield('scripts')  
<script src="{{url('media/js/app.min.js')}}"></script>
</body>
</html>
