<?php 
namespace App\Http\Middleware;

use Closure,Session,Route,App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\SessionManager;

class Setter
{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @param  string|null  $guard
   * @return mixed
   */
  public function handle($request, Closure $next, $guard = null) {

    if( !$request->session()->get('session_key') ) {
      $request->session()->put('session_key', false);
    }

    $controllers = [];

    if ($request->isMethod('get')) {
      foreach (Route::getRoutes()->getRoutes() as $route)
      {
        $action = $route->getAction();
        if (array_key_exists('controller', $action))
        {
            // You can also use explode('@', $action['controller']); here
            // to separate the class name from the method
            $controller = explode("@", $action['controller'])[0];
            if(!in_array("$controller@hook", $controllers)) {

              if( method_exists($controller, "hook") ) {
                $controllers[] = "$controller@hook";
                App::call("$controller@hook");
              }
            }
        }
      }
    }
    

    return $next($request);
  }

}
