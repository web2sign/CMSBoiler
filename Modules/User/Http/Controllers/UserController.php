<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\User;

class UserController extends Controller
{
  public function hook(){
    \Hooks::add('admin_menu',function(){
      if( \Helper::hasAccess('module.admin.user.read') ) {

        $html = '
        <li class="treeview '. (\Request::is('admin/users') || \Request::is('admin/users/*')  || \Request::is('admin/user/*') ? ' active' : '') .'">
          <a href="#"><i class="fa fa-user"></i> <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li'.(\Request::is('admin/users') || \Request::is('admin/users/*') ? ' class="active"' : '').'><a href="'.url('admin/users').'"><i class="fa fa-circle-o"></i> View Users</a></li>
            '. ( \Helper::hasAccess('module.admin.user.create') ? '<li'. (\Request::is('admin/user/create') ? ' class="active"' : '').'><a href="'.url('admin/user/create').'"><i class="fa fa-circle-o"></i> Create User</a></li>' : '' ) .'
          </ul>
        </li>
        ';

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
      //dd( Page::paginate(1) );
      $users = User::orderByRaw("b.id,users.id ASC")->select([
        'users.*'
      ])
      ->leftJoin('user_group as a','a.user_id','=','users.id')
      ->leftJoin('groups as b','b.id','=','a.group_id');


      if($search) {
        $users = $users->where(function($q) use($search){
          $q->where( 'username', 'ilike', "%$search%" );
          $q->orWhere('email', 'ilike', "%$search%" );
        });
      }

      $pagination = $users->paginate($limit);

      return view('user::index',[
        'users' => $users->get()->map(function($q){
          $q->meta()->get()->map(function($qq) use(&$q){
            $q->setAttribute($qq->metakey,$qq->metavalue);
          });
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
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
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
    public function destroy()
    {
    }
}
