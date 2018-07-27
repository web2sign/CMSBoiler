<?php

namespace Modules\Admin\Http\Controllers;

use Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{

  public function hook(){

    \Hooks::add('admin_menu',function(){
    
      $html = '<li '.(Request::is('admin/dashboard') ? ' class="active"' : '') .'><a href="'.url('admin/dashboard').'"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>';

      return $html;
    }, 10);

  }

  /**
   * Display a listing of the resource.
   * @return Response
   */
  public function index()
  {
      return view('admin::index');
  }

}
