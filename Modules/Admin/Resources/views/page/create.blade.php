@extends('admin::layouts.master')
@section('page_title', env('APP_NAME') . ' | Dashboard')
@section('body_class', 'hold-transition skin-blue sidebar-mini')
@section('styles')
  <link href="{{url('media/fine-uploader/fine-uploader-gallery.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="{{ url('media/plugins/iCheck/square/blue.css') }}" />
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
  <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
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
        Create Page <a class="btn btn-danger" href="{{ url('admin/pages') }}">Cancel</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{ url('admin/pages') }}">Pages</a></li>
        <li class="active">Create Page</li>
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




      <form action="{{ url('admin/page/create') }}" method="post">
        @csrf
      
        <div class="row">
          <div class="col-sm-8">

            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Page Title</h3>
              </div>
              <div class="box-body">
                <input value="{{ old('title') }}" required="required" class="form-control input-lg" type="text" placeholder="Title" name="title" />
              </div>
              <!-- /.box-body -->
            </div>
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Page Content</h3>
              </div>
              <div class="box-body">
                <textarea required="required" class="form-control ckeditor" name="content" placeholder="Content">{{ old('content') }}</textarea>
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
                  <textarea name="meta[keywords]" class="form-control" rows="2" placeholder="e.g. gundam, robots, mechanical">{{ old('meta')['keywords'] }}</textarea>
                </p>
                <p>
                  <label>Meta Description</label>
                  <textarea name="meta[description]" class="form-control" rows="4" placeholder="e.g. Model kits depicting the vehicles and characters of the fictional Gundam.">{{ old('meta')['description'] }}</textarea>
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
                  <select name="parent_id" class="input-lg form-control">
                    <option value="0">None</option>
                    @foreach($parents as $parent)
                    <option value="{{$parent->id}}" {{ old('parent_id') == $parent->id ? 'selected="selected"' : '' }}>{{$parent->title}}</option>
                    @endforeach
                  </select>
                </p>
                <p>
                  <label>Slug</label>
                  <input required="required" name="slug" class="form-control input-lg" type="text" placeholder="Slug" value="{{ old('slug') }}" />
                  <small style="color:#999">{{ url('/') }}/<strong>slug</strong></small>
                </p>
                
                <!-- <p>
                  <label>Layout</label>
                  <select class="input-lg form-control">
                    <option>Full Page</option>
                    <option>With Left Sidebar</option>
                    <option>With Right Sidebar</option>
                    <option>With Left and Right Sidebar</option>
                  </select>
                </p> -->


                <p>
                  <label class="blk">Featured Image</label>
                  <input class="input-featured-image" type="hidden" name="meta[featured_image]" value="{{ old('meta')['featured_image'] }}" />
                  @if(isset(old('meta')['featured_image']))
                  <span class="featured-image active"><img src="https://ecommerce.test/media/thumbnail/{{old('meta')['featured_image']}}?w=150&h=150" /></span>
                  @else
                  <span class="featured-image"></span>
                  @endif

                  
                  <div><a data-fancy data-type="ajax" data-modal="true" data-src="{{ url('admin/media/choose') . ( old('meta')['featured_image'] ? '?id=' . old('meta')['featured_image'] : '' ) }}" data-url="{{ url('admin/media/choose') }}" class="btn btn-xs btn-default choose-image-btn">Choose Image</a></div>
                </p>

                <br>
                
                <button name="status" value="1" type="submit" class="btn btn-success">Publish</button>
                <button name="status" value="0" type="submit" class="btn btn-warning">Save as draft</button>
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
