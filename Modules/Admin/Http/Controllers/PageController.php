<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Hooks;

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

      $html = '
      <div class="col-lg-4">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($page=1, Request $request)
    {

      $limit = $request->get('limit', env('LIMIT'));

      $pages = Page::where(function($q){
        $q->where('parent_id',null);
        $q->orWhere('parent_id',0);
      })->with(['children','children.children']);

      dd($pages->get()->toArray());


      return view('admin::page.index',[
        'post_type' => $this->post_type
      ]);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::page.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      dd($request->all());
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
    public function edit()
    {
        return view('admin::page.update');
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
