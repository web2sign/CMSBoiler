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
  <script src="{{url('media/fine-uploader/fine-uploader.min.js')}}"></script>
  <script type="text/template" id="qq-template">
        <div class="qq-uploader-selector qq-uploader">
            
            <div class="qq-upload-button-selector qq-upload-button">
                <div class="btn btn-sm btn-default">Upload a file</div>
            </div>

            <ul style="display:none;" class="qq-upload-list-selector qq-upload-list" role="region" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                    <div class="qq-progress-bar-container-selector qq-progress-bar-container">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <div class="qq-thumbnail-wrapper">
                        <img class="qq-thumbnail-selector" qq-max-size="120" qq-server-scale>
                    </div>
                    <button type="button" class="qq-upload-cancel-selector qq-upload-cancel">X</button>
                    <button type="button" class="qq-upload-retry-selector qq-upload-retry">
                        <span class="qq-btn qq-retry-icon" aria-label="Retry"></span>
                        Retry
                    </button>

                    <div class="qq-file-info">
                        <div class="qq-file-name">
                            <span class="qq-upload-file-selector qq-upload-file"></span>
                            <span class="qq-edit-filename-icon-selector qq-btn qq-edit-filename-icon" aria-label="Edit filename"></span>
                        </div>
                        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                        <span class="qq-upload-size-selector qq-upload-size"></span>
                        <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">
                            <span class="qq-btn qq-delete-icon" aria-label="Delete"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-pause-selector qq-upload-pause">
                            <span class="qq-btn qq-pause-icon" aria-label="Pause"></span>
                        </button>
                        <button type="button" class="qq-btn qq-upload-continue-selector qq-upload-continue">
                            <span class="qq-btn qq-continue-icon" aria-label="Continue"></span>
                        </button>
                    </div>
                </li>
            </ul>

        </div>
  </script>
  <script>
    $(function () {

      $(document).on('click','[data-select]',function(e){
        e.preventDefault();
        var img = $('<img />');
        img.attr('src', $(this).data('thumbnail') );
        $('.featured-image').empty().addClass('active');
        img.appendTo('.featured-image');
        $('.input-featured-image').val( $(this).data('id') );
        $.fancybox.close();
        $('.choose-image-btn').data('src', $('.choose-image-btn').data('url') + '?id=' + $(this).data('id') );
      });

    });

    $(document).on('click','.featured-image',function(e){
      e.preventDefault();
      $(this).empty().removeClass('active');
      $('.choose-image-btn').data('src', $('.choose-image-btn').data('url'));
    });
  </script>
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
                <h3 class="box-title">General Information</h3>
              </div>
              <div class="box-body">

                <p><label>Group <small class="text-danger">*</small></label>
                  <select name="groups" class="form-control input-lg">
                    <option value="">Select group</option>
                    @foreach( $groups as $group )
                    <option {{ $group->active ? 'selected="true"' : '' }} value="{{ $group->id }}">{{$group->name}}</option>
                    @endforeach
                  </select>
                </p>
                <p><label>Email Address <small class="text-danger">*</small></label>
                <input value="{{ old('email') }}" required="required" class="form-control input-lg" type="email" placeholder="Email Address" name="email" />
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
                    <input value="" required="required" class="form-control input-lg" type="password" placeholder="Password Confirm" name="password_confirm" />
                    </p>
                  </div>
                </div>
                <hr>

                <p>
                  <label class="blk">Avatar</label>
                  <input class="input-featured-image" type="hidden" name="meta[avatar]" value="{{ old('meta')['avatar'] }}" />
                  @if(isset(old('meta')['avatar']))
                  <span class="featured-image active"><img src="{{ url('/') }}/media/thumbnail/{{old('meta')['avatar']}}?w=150&h=150" /></span>
                  @else
                  <span class="featured-image"></span>
                  @endif

                  
                  <div><a data-fancy data-type="ajax" data-modal="true" data-src="{{ url('admin/media/choose') . ( old('meta')['avatar'] ? '?id=' . old('meta')['avatar'] : '' ) }}" data-url="{{ url('admin/media/choose') }}" class="btn btn-xs btn-default choose-image-btn">Choose Image</a></div>
                </p>

                <div class="row">
                  <div class="col-sm-6">
                    <p><label>First Name</label>
                    <input value="{{ old('meta')['first_name'] }}" class="form-control input-lg" type="text" placeholder="First Name" name="meta[first_name]" />
                    </p>
                  </div>
                  <div class="col-sm-6">
                    <p><label>Last Name</label>
                    <input value="{{ old('meta')['last_name'] }}" class="form-control input-lg" type="text" placeholder="Last Name" name="meta[last_name]" />
                    </p>                    
                  </div>
                </div>
                <p><label>Address</label>
                <input value="{{ old('meta')['address'] }}" class="form-control input-lg" type="text" placeholder="Address" name="meta[address]" />
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
                <h3 class="box-title">Custom Permissions</h3>
              </div>
              <div class="box-body">
                <table class="table ">
                  <thead>
                    <tr>
                      <th>Modules</th>
                      <th width="80">Read</th>
                      <th width="80">Create</th>
                      <th width="80">Update</th>
                      <th width="80">Delete</th>
                    </tr>
                  </thead>
                  @foreach($modules['admin'] as $k => $module)
                  <tr class="permit-tr">
                    <td>{{ucfirst($module)}}</td>
                    <td><input data-required-toggle="" value="read" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input data-required-toggle="read" value="create" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input data-required-toggle="read" value="update" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input data-required-toggle="read" value="delete" type="checkbox" name="permits[{{$module}}][]" /></td>
                  </tr>
                  @endforeach
                </table>
                <hr>
                <small><i>Custom permission will let the user access the modules regardless of group assigned.</i></small>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-lg btn-success" type="submit">Create</button>
              </div>
            </div>


          </div>

        </div>



      </form>

    </section>
  </div>
@endsection