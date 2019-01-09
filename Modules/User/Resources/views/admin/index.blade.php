@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Users')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
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
        Users
        @if( Helper::hasAccess('module.admin.user.create') )
        <a class="btn btn-success btn-header" href="{{ url('admin/user/create') }}">Create user</a>
        @endif
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">User</li>
      </ol>
    </section>
    <section class="content">
      
      {!!session()->has('success') ? '<div class="callout callout-success"><h4><i class="icon fa fa-check"></i> Success</h4><p>'. session()->get('success') .'</p></div>' : ''!!}


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Users</h3>

              <div class="box-tools">
                <form method="get" action="{{ url('admin/users') }}">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="s" class="form-control pull-right" placeholder="Search" value="{{ request('s') }}" />

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th width="40">ID</th>
                  <th width="200">User Group</th>
                  <th>Name</th>
                  <th width="180">Date Created</th>
                  <th colspan="2">Action</th>
                </tr>
                @forelse($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>
                    @forelse($user->groups()->get() as $group)
                      {{$group->name}}
                    @empty
                    @endforelse
                  </td>
                  <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                  <td>{{ $user->created_at->diffForHumans() }}</td>
                  <td width="30"><a data-toggle="tooltip" title="Edit" href="{{ url('admin/user/' . $user->id . '/update') }}"><i class="fa fa-edit"></i></a></td>
                  <td width="30"><a data-toggle="tooltip" title="Delete" data-href="{{ url('admin/user/' . $user->id . '/delete') }}" data-delete-item="" href="#"><i class="fa fa-trash"></i></a></td>
                </tr>
                @empty
                <tr>
                  <td colspan="6"><a href="{{ url('admin/user/create') }}">Create a user here</a></td>
                </tr>
                @endforelse
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer clearfix text-center">
              {{ $pagination->links() }}
            </div>
            <!-- /.box-footer -->

          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
  </div>
@endsection
