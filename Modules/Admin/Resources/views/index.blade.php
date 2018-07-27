@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Dashboard')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link href="{{url('media/fine-uploader/fine-uploader-gallery.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
  <script src="{{url('media/fine-uploader/fine-uploader.min.js')}}"></script>
  <script src="{{url('media/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{url('media/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
@endsection

@section('body')
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control Panel</small>
      </h1>
    </section>

    
    <section class="content">

      <div class="row">
      {!! Hooks::do('dashboard') !!}
      </div>

    </section>
    
  </div>

<!-- ./wrapper -->
@endsection