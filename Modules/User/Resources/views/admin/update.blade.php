@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Update User')
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
        Update User <a class="btn btn-danger" href="{{ url('admin/users') }}">Cancel</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/users') }}">Users</a></li>
        <li class="active">Update User</li>
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



      <form action="{{ url('admin/user/'. $user->id .'/update') }}" method="post">
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
                <input value="{{ old('email', $user->email) }}" required="required" class="form-control input-lg" type="email" placeholder="Email Address" name="email" />
                </p>
                <p><label>Username <small class="text-danger">*</small></label>
                <input value="{{ old('username',$user->username) }}" disabled="disabled" class="form-control input-lg" type="text" placeholder="Username" name="username" />
                </p>
                <div class="row">
                  <div class="col-sm-12">
                    <a href="#">Change password</a>
                    </p>
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-6">
                    <p><label>First Name</label>
                    <input value="{{ old('meta', $meta)['first_name'] }}" class="form-control input-lg" type="text" placeholder="First Name" name="meta[first_name]" />
                    </p>
                  </div>
                  <div class="col-sm-6">
                    <p><label>Last Name</label>
                    <input value="{{ old('meta', $meta)['last_name'] }}" class="form-control input-lg" type="text" placeholder="Last Name" name="meta[last_name]" />
                    </p>                    
                  </div>
                </div>
                <p><label>Address</label>
                <input value="{{ old('meta', $meta)['address'] }}" class="form-control input-lg" type="text" placeholder="Address" name="meta[address]" />
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
                    <?php 
                      $g['read'] = false;
                      $g['create'] = false;
                      $g['update'] = false;
                      $g['delete'] = false;
                    ?>
                    @if( $user->permits()->where('module',$module)->count() )
                    <?php 
                      $g['read'] = $user->permits()->where('module',$module)->first()->read;
                      $g['create'] = $user->permits()->where('module',$module)->first()->create;
                      $g['update'] = $user->permits()->where('module',$module)->first()->update;
                      $g['delete'] = $user->permits()->where('module',$module)->first()->delete;
                    ?>
                    @endif
                    <td><input {{ $g['read'] ? 'checked="true"' : '' }} data-required-toggle="" value="read" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $g['create'] ? 'checked="true"' : '' }} data-required-toggle="read" value="create" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $g['update'] ? 'checked="true"' : '' }} data-required-toggle="read" value="update" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $g['delete'] ? 'checked="true"' : '' }} data-required-toggle="read" value="delete" type="checkbox" name="permits[{{$module}}][]" /></td>
                  </tr>
                  @endforeach
                </table>
                <hr>
                <small><i>Custom permission will let the user access the modules regardless of group assigned.</i></small>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-lg btn-success" type="submit">Update</button>
              </div>
            </div>


          </div>

        </div>



      </form>

    </section>
  </div>
@endsection