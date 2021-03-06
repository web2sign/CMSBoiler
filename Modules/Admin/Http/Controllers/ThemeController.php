<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\Page as FormRequest;
use DB, Route;

use Modules\Admin\Entities\Pagemeta;

use Modules\Admin\Entities\Page;

class ThemeController extends Controller
{
    /**
     * Display anything you want in dashboard coming from this module
     * Please note that the responses are compiled and 
     * is wrapped by <div class="row">
     * wrap it with bootstrap column classes
     * @return Response
     */
    public function hook(){

      \Hooks::add('admin_menu',function(){
        if( \Helper::hasAccess('module.admin.theme.read') ) {

          $html = '<li class="treeview '.(\Request::is('admin/themes') || \Request::is('admin/themes/*')  || \Request::is('admin/theme/*') ? ' active' : '') .'"><a href="#"><i class="fa fa-book"></i> <span>Manage Themes</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
              <li'. (\Request::is('admin/themes') || \Request::is('admin/themes/*') ? ' class="active"' : '') .'><a href="'.url('admin/themes').'"><i class="fa fa-circle-o"></i> View Themes</a></li>
              '. ( \Helper::hasAccess('module.admin.theme.create') ? '<li'. (\Request::is('admin/theme/create') ? ' class="active"' : '') .'><a href="'.url('admin/theme/create').'"><i class="fa fa-circle-o"></i> Upload Theme</a></li>' : '' ) .'
            </ul>
          </li>';
        }
        return isset($html) ? $html : '';
      }, 21);

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
      $request->request->add(['user_id'=>Helper::getUser()->id]);
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
