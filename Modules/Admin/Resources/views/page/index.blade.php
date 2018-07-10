@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Dashboard')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
  <script src="{{url('media/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{url('media/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
@endsection

@section('body')
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        Pages
        <a class="btn btn-success btn-header" href="{{ url('admin/page/create') }}">Create page</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Page</li>
      </ol>
    </section>

    
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Pages</h3>

              <div class="box-tools">
                <form method="get" action="{{ url('admin/pages') }}">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="s" class="form-control pull-right" placeholder="Search" />

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
                  <th width="60"><a href="{{ url('admin/pages') }}?sort=id&orderby={{ (Request::get('orderby') == 'desc' ? 'asc': 'desc') }}">ID</a></th>
                  <th><a href="{{ url('admin/pages') }}?sort=title&orderby={{ (Request::get('orderby') == 'desc' ? 'asc': 'desc') }}">Title</a></th>
                  <th width="180"><a href="{{ url('admin/pages') }}?sort=created_at&orderby={{ (Request::get('orderby') == 'desc' ? 'asc': 'desc') }}">Date</a></th>
                  <th width="100"><a href="{{ url('admin/pages') }}?sort=status&orderby={{ (Request::get('orderby') == 'desc' ? 'asc': 'desc') }}">Status</a></th>
                  <th colspan="2">Action</th>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Home</td>
                  <td>July 13, 2018</td>
                  <td><span class="label label-success">Published</span></td>
                  <td width="30"><a href="{{ url('admin/page/1/update') }}"><i class="fa fa-edit"></i></a></td>
                  <td width="30"><a href="{{ url('admin/page/1/delete') }}"><i class="fa fa-trash"></i></a></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
            <!-- /.box-footer -->

          </div>
          <!-- /.box -->
        </div>
      </div>

    </section>
    
  </div>

<!-- ./wrapper -->
@endsection
