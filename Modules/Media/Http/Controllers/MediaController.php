<?php

namespace Modules\Media\Http\Controllers;

use File, Carbon\Carbon, Image;
use Illuminate\Http\Request;
use Modules\Media\Http\Requests\UploadRequest;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Media\Entities\Media;

class MediaController extends Controller
{


  public function hook(){
    \Hooks::add('admin_menu',function(){
      
      if( \Helper::hasAccess('module.admin.media.read') ) {
        $html = '<li '.(\Request::is('admin/media/files') ? ' class="active"' : '') .'><a href="'.url('admin/media/files').'"><i class="fa fa-file"></i> <span>Media Library</span></a></li>';
      }

      return isset($html) ? $html : '';

    }, 10);


  }

  public function info($id) {
    $media = Media::find($id);
    $url = str_replace( public_path(), '', $media->path);
    $media->setAttribute('url', url($url));
    $media->setAttribute('thumbnail', url('media/thumbnail/'.$media->id.'?w=150&h=150'));
    
    return view('media::details',[
      'media' => $media
    ]);
  }

  public function choices() {
    $id = request('id', 0);
    $media = Media::where("file_type","like","%image%");
    $media = $media->orderByRaw("
        CASE 
        WHEN id = $id THEN 0
        ELSE 1
        END ASC
      ");
    $media = $media->get()->map(function($q) use($id){
                    $q->setAttribute('selected',($q->id == $id));
                    $q->setAttribute('thumbnail', url('media/thumbnail/'.$q->id.'?w=150&h=150'));
                    return $q;
                  });
    return view('media::choices',[
      'images' => $media
    ]);
  }



    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, Media $media)
    {
      $limit = $request->get('limit', env('LIMIT'));
      $search = $request->get('s');
      
      if($search) {
        $media = $media->where(function($q) use($search){
          $q->where( 'name', 'ilike', "%$search%" );
        });
      }

      $media = $media->orderBy('created_at','desc');


      $pagination = $media->paginate(50);



      return view('media::index',[
        'files' => $media->get()->map(function($q){
          $url = str_replace( public_path(), '', $q->path);
          $q->setAttribute('url', url($url));
          $q->setAttribute('thumbnail', url('media/thumbnail/'.$q->id.'?w=150&h=150'));

          return $q;
        }),
        'pagination' => $pagination
      ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      return view('media::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(UploadRequest $request)
    {

      $file = $request->file('qqfile');

      $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
      $ext = $file->getClientOriginalExtension();


      $destiny = 'uploads/admin/' . Carbon::today()->format('Y/m/d/');
      //File::deleteDirectory(public_path($destiny));


      if(!File::exists( public_path( $destiny) ) ) {
        $check = File::makeDirectory($destiny, 0755, true, true);
        if( !$check ) {
          return [
            'success' => false,
            'error' => 'Please have a proper permission to your directory.'
          ];
        }
      }
      $file_name = $file->getClientOriginalName();
      $i = 1;
      while( File::exists( public_path( $destiny ) . $file_name ) ) {
        $file_name = $original_name . '-' . $i . '.' . $ext;
        $i++;
      }



      $media = Media::create([
        'file_type' => $file->getMimeType(),
        'name' => $file_name,
        'path' => $destiny . $file_name
      ]);

      $file->move( public_path($destiny), $file_name );

      return [
        'success' => true,
        'info' => [
          'file_name' => $file_name,
          'id'=> $media->id
        ]
      ];

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
      $w = request('w',150);
      $h = request('h',150);
      $media = Media::find($id);
      
      if( $media ) {
        if( File::exists($media->path) ) {
          if (false !== mb_strpos( $media->file_type, "image")) {
            $img = Image::make($media->path)->fit($w, $h);
          } else {
            $img = Image::make( public_path( 'media/file.jpg' ) )->fit($w, $h);
          }
        } else {
          $img = Image::make( public_path( 'media/no-file.png' ) )->fit($w, $h);
        }
      } else {
        $img = Image::make( public_path( 'media/no-file.png' ) )->fit($w, $h);
      }

      return $img->response('jpg');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('media::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $file = Media::find($id);

      if(File::exists($file->path)) {
        File::delete($file->path);
      }
      $file->delete();

      return ['success'=> true];
    }

}
