<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\Page as FormRequest;
use Hooks,DB;

use Modules\Admin\Entities\Page;

class PageController extends Controller
{
    /**
     * Display anything you want in dashboard coming from this module
     * Please note that the responses are compiled and 
     * is wrapped by <div class="row">
     * wrap it with bootstrap column classes
     * @return Response
     */
    public function hook(){
      Hooks::add('dashboard',function(){
      $active_pages = Page::where('status',true)->count();
      $html = '
      <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>'.$active_pages.'</h3>

            <p>Active pages</p>
          </div>
          <div class="icon">
            <i class="ion ion-folder"></i>
          </div>
          <a href="' . url('admin/pages') . '" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->';

        return $html;
      }, 10);
    }


    /* 
     * Set a defualt post type for page
     *
    **/
    public $post_type = "page";

    public function __construct(Request $request) {
      $action = $request->route()->getAction();
      $post_type = isset($action['post_type']) ? $action['post_type'] : 'page';
      $this->post_type = $post_type;
      $request->request->add(['__post_type'=>$post_type]);
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

      $limit = $request->get('limit', env('LIMIT'));
      $search = $request->get('s');
      $sort = $request->get('sort');
      $by = $request->get('by');
      //dd( Page::paginate(1) );
      $pages = Page::orderByRaw("
        CASE 
        WHEN parent_id = 0 THEN id
        ELSE parent_id
        END ASC
      ");
      
      if($search) {
        $pages = $pages->where(function($q) use($search){
          $q->where( 'title', 'ilike', "%$search%" );
          $q->orWhere('content', 'ilike', "%$search%" );
        });
      }


      $pagination = $pages->paginate($limit);

      return view('admin::page.index',[
        'post_type' => $this->post_type,
        'pages' => $pages->get(),
        'pagination' => $pagination
      ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $parents = Page::select(['id','title'])->where('parent_id', 0);
      return view('admin::page.create',[
        'parents' => $parents->get()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(FormRequest $request)
    {
      $page = Page::create($request->all());
      return redirect()->to('admin/page/' . $page->id . '/update')->with('status', 'Page has been successfully created!')->send();
      
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::page.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $parents = Page::select(['id','title'])->where('parent_id', 0);

      $page = Page::with('parent')->find($id);

      return view('admin::page.update',[
        'parents' => $parents->get(),
        'page' => $page
      ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
      $parents = Page::select(['id','title'])->where('parent_id', 0);

      $page = Page::with('parent')->find($id);

      return view('admin::page.update',[
        'parents' => $parents->get(),
        'page' => $page
      ]);
    }


    /**
     * Delete the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
