<?php

namespace Modules\Group\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;


use Modules\Group\Http\Requests\Group as GroupRequest;
use Modules\Admin\Entities\Group;
use Modules\Admin\Entities\Upermit;



class GroupAdminController extends Controller
{

    public function hook() {

      \Hooks::add('admin_menu',function(){
        if( \Helper::hasAccess('module.admin.group.read') ) {

          $html = '<li class="treeview '.(\Request::is('admin/groups') || \Request::is('admin/groups/*')  || \Request::is('admin/group/*') ? ' active' : '') .'"><a href="#"><i class="fa fa-book"></i> <span>Manage Groups</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
              <li'. (\Request::is('admin/groups') || \Request::is('admin/groups/*') ? ' class="active"' : '') .'><a href="'.url('admin/groups').'"><i class="fa fa-circle-o"></i> View Groups</a></li>
              '. ( \Helper::hasAccess('module.admin.group.create') ? '<li'. (\Request::is('admin/group/create') ? ' class="active"' : '') .'><a href="'.url('admin/group/create').'"><i class="fa fa-circle-o"></i> Create Group</a></li>' : '' ) .'
            </ul>
          </li>';
        }
        return isset($html) ? $html : '';
      }, 21);

    }


    public function __construct(Request $request) {

    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request  $request)
    {
        $limit = $request->get('limit', env('LIMIT'));
        $search = $request->get('s');
        $sort = $request->get('sort');
        $by = $request->get('by');
        
        $groups = Group::orderByRaw("id ASC");
        
        if($search) {
          $groups = $groups->where(function($q) use($search){
            $q->where( 'name', 'like', "%$search%" );
            $q->orWhere('description', 'like', "%$search%" );
          });
        }


        $pagination = $groups->paginate($limit);

        return view('group::admin.index',[
          'groups' => $groups->get(),
          'pagination' => $pagination
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        $modules = \Helper::getModules();
        return view('group::admin.create',[
            'modules' => $modules
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(GroupRequest $request)
    {
      $group = Group::create([
        'name'=>request()->get('name'),
        'description'=>request()->get('description')
      ]);


      $custom_permits = [];
      if( request()->get('permits') ) {
        foreach( request()->get('permits') as $module => $methods){
          $default_methods = [
            'read' => 0,
            'create' => 0,
            'update' => 0,
            'delete' => 0
          ];

          foreach($methods as $method) {
            $default_methods[$method] = 1;
          }

          if( $group->permits()->where('module', $module)->count() ) {
            $group->permits()->where('module', $module)->update([
              'create' => $default_methods['create'],
              'read' => $default_methods['read'],
              'update' => $default_methods['update'],
              'delete' => $default_methods['delete']
            ]);
          } else {
            $custom_permits[] = new UPermit([
              'module' => $module,
              'create' => $default_methods['create'],
              'read' => $default_methods['read'],
              'update' => $default_methods['update'],
              'delete' => $default_methods['delete']
            ]);
          }

        }
      }

      if( count($custom_permits) ) {
        $group->permits()->saveMany($custom_permits);
      }

      return redirect()->
             to('admin/groups?sort=desc')->
             withSuccess('Group has been successfully created!')->
             send();

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('group::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
      $group = Group::find($id);
      
      $modules = \Helper::getModules();
      
      return view('group::admin.update',[
        'modules' => $modules,
        'group' => $group
      ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  GroupRequest $request
     * @return Response
     */
    public function update($id, GroupRequest $request)
    {
      $group = Group::find($id);
      $group->update([
        'name' => $request->get('name'),
        'description' => $request->get('description')
      ]);


      $custom_permits = [];
      if( request()->get('permits') ) {
        foreach( request()->get('permits') as $module => $methods){
          $default_methods = [
            'read' => 0,
            'create' => 0,
            'update' => 0,
            'delete' => 0
          ];

          foreach($methods as $method) {
            $default_methods[$method] = 1;
          }

          if( $group->permits()->where('module', $module)->count() ) {
            $group->permits()->where('module', $module)->update([
              'create' => $default_methods['create'],
              'read' => $default_methods['read'],
              'update' => $default_methods['update'],
              'delete' => $default_methods['delete']
            ]);
          } else {
            $custom_permits[] = new UPermit([
              'module' => $module,
              'create' => $default_methods['create'],
              'read' => $default_methods['read'],
              'update' => $default_methods['update'],
              'delete' => $default_methods['delete']
            ]);
          }

        }
      }

      if( count($custom_permits) ) {
        $group->permits()->delete();
        $group->permits()->saveMany($custom_permits);
      }

      return redirect()->
             to('admin/groups?sort=desc')->
             withSuccess('Group has been successfully created!')->
             send();

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
      $group = Group::find($id);
      if(!$group) {
        return redirect()->to('admin/groups')->withErrors(['msg','Something went wrong.']);
      }

      $group->delete();

      return redirect()->to('admin/groups')->withSuccess('Group successfully deleted.');
    }
}
