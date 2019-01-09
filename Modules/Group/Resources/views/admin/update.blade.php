@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Update Group')
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
        Update Group <a class="btn btn-danger" href="{{ url('admin/groups') }}">Cancel</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/groups') }}">Groups</a></li>
        <li class="active">Update Group</li>
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



      <form action="{{ url('admin/group/'. $group->id .'/update') }}" method="post">
        @csrf


        <div class="row">
          
          <div class="col-sm-8">
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">General Information</h3>
              </div>
              <div class="box-body">

                <p><label>Name <small class="text-danger">*</small></label>
                <input value="{{ old('name', $group->name) }}" required="required" class="form-control input-lg" type="name" placeholder="Name" name="name" />
                </p>
                <p><label>Description</label>
                  <textarea class="form-control input-lg" name="description" id="description">{{ old('description', $group->description) }}</textarea>
                </p>
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
                    @if( $group->permits()->where('module',$module)->count() )
                    <?php 
                      $g['read'] = $group->permits()->where('module',$module)->first()->read;
                      $g['create'] = $group->permits()->where('module',$module)->first()->create;
                      $g['update'] = $group->permits()->where('module',$module)->first()->update;
                      $g['delete'] = $group->permits()->where('module',$module)->first()->delete;
                    ?>
                    @endif
                    <td><input {{ $group->id == 1 ? 'disabled="disabled" checked="true"' : '' }} {{ $g['read'] ? 'checked="true"' : '' }} data-required-toggle="" value="read" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $group->id == 1 ? 'disabled="disabled" checked="true"' : '' }} {{ $g['create'] ? 'checked="true"' : '' }} data-required-toggle="read" value="create" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $group->id == 1 ? 'disabled="disabled" checked="true"' : '' }} {{ $g['update'] ? 'checked="true"' : '' }} data-required-toggle="read" value="update" type="checkbox" name="permits[{{$module}}][]" /></td>
                    <td><input {{ $group->id == 1 ? 'disabled="disabled" checked="true"' : '' }} {{ $g['delete'] ? 'checked="true"' : '' }} data-required-toggle="read" value="delete" type="checkbox" name="permits[{{$module}}][]" /></td>
                  </tr>
                  @endforeach
                </table>
                {!! $group->id == 1 ? '<small>Primary Usergroup\'s permission is not allowed to be modified.</small>' : ''!!}
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