@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Create User')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
  <script src="{{url('media/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{url('media/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
@endsection

@section('body')


  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        Create User <a class="btn btn-danger" href="{{ url('admin/users') }}">Cancel</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/users') }}">Users</a></li>
        <li class="active">Create User</li>
      </ol>
    </section>

    <section class="content">


    @if ($errors->any())
      <ul class="callout callout-danger"> 
    @foreach ( $errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
      </ul>
    @endif



      <form action="{{ url('admin/user/create') }}" method="post">
        @csrf


        <div class="row">
          
          <div class="col-sm-8">

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">User Information</h3>
              </div>
              <div class="box-body">
                <p><label>Email Address <small class="text-danger">*</small></label>
                <input value="{{ old('username') }}" required="required" class="form-control input-lg" type="email" placeholder="Email Address" name="email_address" />
                </p>
                <p><label>Username <small class="text-danger">*</small></label>
                <input value="{{ old('username') }}" required="required" class="form-control input-lg" type="text" placeholder="Username" name="username" />
                </p>
                <div class="row">
                  <div class="col-sm-6">
                    <p><label>Password <small class="text-danger">*</small></label>
                    <input value="{{ old('password') }}" required="required" class="form-control input-lg" type="password" placeholder="Password" name="password" />
                    </p>
                  </div>
                  <div class="col-sm-6">
                    <p><label>Password Confirm <small class="text-danger">*</small></label>
                    <input value="{{ old('password_confirm') }}" required="required" class="form-control input-lg" type="password" placeholder="Password Confirm" name="password_confirm" />
                    </p>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <p><label>First Name</label>
                    <input value="{{ old('meta')['first_name'] }}" class="form-control input-lg" type="text" placeholder="First Name" name="meta[first_name]" />
                    </p>
                  </div>
                  <div class="col-sm-6">
                    <p><label>Last Name</label>
                    <input value="{{ old('meta')['last_name'] }}" required="required" class="form-control input-lg" type="text" placeholder="Last Name" name="last_name" />
                    </p>                    
                  </div>
                </div>
                <p><label>Address</label>
                <input value="{{ old('meta')['address'] }}" required="required" class="form-control input-lg" type="text" placeholder="Address" name="meta[address]" />
                </p>
              </div>
              <!-- <div class="box-footer">
                <a class="btn btn-default" href="#"><i class="fa fa-plus"></i> Add More Field</a>
              </div> -->
              <!-- /.box-body -->
            </div>

          </div>

          <div class="col-sm-4">

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Page Content</h3>
              </div>
              <div class="box-body">
                <textarea required="required" class="form-control ckeditor" name="content" placeholder="Content">{{ old('content') }}</textarea>
              </div>
              <!-- /.box-body -->
            </div>


          </div>

        </div>



      </form>

    </section>
  </div>
@endsection