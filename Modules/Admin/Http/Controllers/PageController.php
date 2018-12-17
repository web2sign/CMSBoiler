<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\Page as FormRequest;
use DB;

use Modules\Admin\Entities\Pagemeta;

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
      \Hooks::add('dashboard',function(){
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

      \Hooks::add('admin_menu',function(){
        if( \Helper::hasAccess('module.admin.page.read') ) {

          $html = '<li class="treeview '.(\Request::is('admin/pages') || \Request::is('admin/pages/*')  || \Request::is('admin/page/*') ? ' active' : '') .'"><a href="#"><i class="fa fa-book"></i> <span>Manage Pages</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
              <li'. (\Request::is('admin/pages') || \Request::is('admin/pages/*') ? ' class="active"' : '') .'><a href="'.url('admin/pages').'"><i class="fa fa-circle-o"></i> View Pages</a></li>
              '. ( \Helper::hasAccess('module.admin.page.create') ? '<li'. (\Request::is('admin/page/create') ? ' class="active"' : '') .'><a href="'.url('admin/page/create').'"><i class="fa fa-circle-o"></i> Create Pages</a></li>' : '' ) .'
            </ul>
          </li>';
        }
        return isset($html) ? $html : '';
      }, 21);

    }


    /* 
     * Set a default post type for page
     *
    **/
    public $post_type = "page";

    public function __construct(Request $request) {
      
      /*if( !method_exists($request->route, 'getAction') ) {
        return false;
      }*/

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
      
      $pages = Page::where('post_type',$this->post_type)->orderByRaw("
        CASE 
        WHEN parent_id = 0 THEN id
        ELSE parent_id
        END DESC,
        id ASC
      ");
      
      if($search) {
        $pages = $pages->where(function($q) use($search){
          $q->where( 'title', 'like', "%$search%" );
          $q->orWhere('content', 'like', "%$search%" );
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

      $parents = Page::select(['id','title'])
                      ->where('parent_id', 0);
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
      if($meta = $request->get('meta')) {
        foreach ($meta as $key => $value) {
          $page->meta()->saveMany([
            new Pagemeta([
              'metakey' => $key,
              'metavalue' => $value
            ]),
          ]);
        }
      }


      $message = ($request->get('status') == 1) ? ucfirst($this->post_type) . ' successfully published!' : ucfirst($this->post_type) . ' successfully saved as draft.';

      return redirect()->
             to('admin/pages')->
             withSuccess($message)->
             send();
      
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
      $parents = Page::select(['id','title'])->where('parent_id', 0)->where('id','<>',$id);

      $page = Page::with(['parent','meta'])->find($id);
      $meta = [];

      $page->meta()->get()->map(function($q) use(&$meta){
        $meta[$q->metakey] = $q->metavalue;
      });

      $data = [
        'parents' => $parents->get(),
        'page' => $page,
        'meta' => $meta
      ];

      foreach($page->meta as $key => $value) {
        $data[$key] = $value;
      }

      return view('admin::page.update',$data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, FormRequest $request)
    {
      $parents = Page::select(['id','title'])->where('parent_id', 0);

      $page = Page::with('parent')->find($id);
      $page->update($request->all());
      if($meta = $request->get('meta')) {
        foreach ($meta as $key => $value) {

          if( $page->meta()->where('metakey', $key)->count() ) {
            $page->meta()->where('metakey', $key)->update([
              'metavalue' => $value
            ]);
          } else {
            $page->meta()->saveMany([
              new Pagemeta([
                'metakey' => $key,
                'metavalue' => $value
              ]),
            ]);            
          }

        }
      }


      $message = ($request->get('status') == 1) ? ucfirst($this->post_type) . ' successfully published!' : ucfirst($this->post_type) . ' successfully saved as draft.';

      return redirect()->
             to('admin/pages')->
             withSuccess($message)->
             send();
      
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $page = Page::find($id);
      if(!$page) {
        return redirect()->to('admin/pages')->withErrors(['msg','Something went wrong.']);
      }

      $page->children()->get()->map(function($q){
        $q->update(['parent_id'=>0]);
        return $q;
      });

      $page->delete();

      return redirect()->to('admin/pages')->withSuccess('Page successfully deleted.');
    }
}
