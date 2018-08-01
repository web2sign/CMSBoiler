@extends('admin::layouts.app')
@section('page_title','Login')
@section('body_class','hold-transition login-page')
@section('styles')
<link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
<script src="{{url('media/plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endsection



@section('body')
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}"><strong>Control Panel</strong></a>
  </div>
@if ($errors->any())

  <ul class="callout callout-danger" style="padding-left:30px"> 
@foreach ( $errors->all() as $error)
  <li>{{ $error }}</li>
@endforeach
  </ul>
@endif

  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ url('/admin/login') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" value="1" /> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- /.social-auth-links -->

    <a href="{{url('admin/login/forgot-password')}}">I forgot my password</a><br>

  </div>

</div>
@endsection