
<div style="max-width: 100%; width:960px;" class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Please Featured Image 
      <span id="fine-uploader"></span>
    </h3>
     <button style="float:right; margin-top:-10px" data-fancybox-close="" type="button" class="btn btn-xs btn-default"><i class="fa fa-close"></i></button>
  </div>
  <div class="box-body box-body-image-choices">
    @forelse($images as $image)
    <a data-select data-id="{{ $image->id }}" data-thumbnail="{{ $image->thumbnail }}" style="float:left;" href="#" class="thumbnail{{($image->selected ? ' selected' : '')}}"><img src="{{ $image->thumbnail }}" /></a>
    @empty
    test
    @endforelse
  </div>
  <!-- /.box-body -->


</div>
