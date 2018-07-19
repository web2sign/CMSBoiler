<div class="container">
  <button style="position: absolute; top:10px; right:10px;" data-fancybox-close="" type="button" class="btn btn-default"><i class="fa fa-close"></i></button>


  <div class="row">
    <div class="col-sm-3">
      <img class="thumbnail" src="{{ $media->thumbnail }}" />
    </div>

    <div class="col-sm-8">
      <p>
        <label>File Name</label>
        <input class="form-control" value="{{ $media->name }}" />
      </p>
      <p>
        <label>Url</label>
        <input class="form-control" value="{{ $media->url }}" />
      </p>
      <p>
        <label>Thumbnail <small>( Cusomizable Size )</small></label>
        <input class="form-control" value="{{ $media->thumbnail }}" />
      </p>
    </div>
  </div>
</div>