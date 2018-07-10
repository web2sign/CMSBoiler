@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Dashboard')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
  <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <script src="{{url('media/plugins/iCheck/icheck.min.js')}}"></script>
  <script src="{{url('media/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
  <script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      //CKEDITOR.replace('editor1');

    });
  </script>
@endsection

@section('body')
  <div class="content-wrapper">
    
    <section class="content-header">
      <h1>
        Create Page
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/pages') }}">Pages</a></li>
        <li class="active">Create Page</li>
      </ol>
    </section>

    
    <section class="content">

      <form action="{{ url('admin/page/create') }}" method="post">
        @csrf
      
        <div class="row">
          <div class="col-sm-8">

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Page Title</h3>
              </div>
              <div class="box-body">
                <input class="form-control input-lg" type="text" placeholder="Title" name="content" />
              </div>
              <!-- /.box-body -->
            </div>
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Page Content</h3>
              </div>
              <div class="box-body">
                <textarea class="form-control ckeditor" name="content" placeholder="Content"></textarea>
              </div>
              <!-- /.box-body -->
            </div>

            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Meta Data <small>Can help boost your site to search engines</small></h3>
              </div>
              <div class="box-body">
                <p>
                  <label>Meta Keywords</label>
                  <textarea class="form-control" rows="2" placeholder="e.g. gundam, robots, mechanical"></textarea>
                </p>
                <p>
                  <label>Meta Keywords</label>
                  <textarea class="form-control" rows="4" placeholder="e.g. Model kits depicting the vehicles and characters of the fictional Gundam."></textarea>
                </p>
              </div>
              <!-- /.box-body -->
            </div>
          </div>


          <div class="col-sm-4">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Page Attributes</h3>
              </div>
              <div class="box-body">
                <p>
                  <label>Parent</label>
                  <select class="input-lg form-control">
                    <option>None</option>
                  </select>
                </p>
                <p>
                  <label>Slug</label>
                  <input class="form-control input-lg" type="text" placeholder="Slug">
                  <small style="color:#999">{{ url('/') }}/<strong>slug</strong></small>
                </p>
                
                <p>
                  <label>Layout</label>
                  <select class="input-lg form-control">
                    <option>Full Page</option>
                    <option>With Left Sidebar</option>
                    <option>With Right Sidebar</option>
                    <option>With Left and Right Sidebar</option>
                  </select>
                </p>


                <p>
                  <label>Featured Image</label>
                  <input type="file" name="featured_image">
                </p>
                <br>
                
                <button name="status" value="publish" type="submit" class="btn btn-success">Publish</button>
                <button name="status" value="draft" type="submit" class="btn btn-warning">Save as draft</button>
              </div>
              <!-- /.box-body -->
            </div>


          </div>


        </div>
      </form>


    </section>
    
  </div>

<!-- ./wrapper -->
@endsection
