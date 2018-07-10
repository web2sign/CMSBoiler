<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Helper;


class AuthAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {

    if( !$session_key = $request->session()->get('session_key') ) {
      return redirect()->to('admin/login')->send();
    }
    
    if( !Helper::checkSession($session_key,'admin') ){
      return redirect()->to('/')->send();
    }


    if( !Helper::hasAccess() ) {
      return redirect()->to('/admin')->send();
    }

    return $next($request);
  }
}
