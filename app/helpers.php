<?php
use Modules\Admin\Entities\Usession, Carbon\Carbon;

class Hooks {
  public static $actions = [];
  public static function do($key){
    $html = [];
    if( isset(self::$actions[$key]) ) {
      ksort(self::$actions[$key]);
      foreach(self::$actions[$key] as $key => $action) {
        if( is_callable($action) ) {
          $html[] = $action();
        } else {
          $html[] = $action;
        }
      }
    }
    $_html = implode("", $html);
    return $_html;
  }

  public static function add($key,$func, $priority = 101) {
    if(isset(self::$actions[$key])) {
      while( array_key_exists($priority, self::$actions[$key]) ) {
        $priority++;
      }
    }
    self::$actions[$key][$priority] = $func;
  }
}


class Helper {

  public static $user = [];


  public static function checkSession($session_key, $session_type){
    $session = Usession::
    where('expired_at','>=', Carbon::now())->
    where('session_key','=',$session_key)->
    first();

    if( !$session ){return false;}
    if($session->session_type != $session_type ){return false;}
    self::$user = $session->user;
    return true;
  }



  public static function hasAccess($current_route=false){
    $user = self::$user;
    if(!$current_route) {
      $current_route = \Request::route()->getName();
    }
    $module = explode(".", $current_route);
    
    // if route is not module
    if( !isset($module[0]) || $module[0] != 'module' ) {
      return true;
    }

    $module_type = $module[1];
    $module_name = $module[2];
    $module_method = $module[3];

    //dd($user->groups()->with(['permits'])->get()->toArray());


    // check if user has permit itself
    $permitted = $user->permits()->where(function($q) use($module_method){
      $q->where('module','*');
      $q->where($module_method, 1);
    })->orWhere(function($q) use($module_name,$module_method){
      $q->where('module',$module_name);
      $q->where($module_method, 1);
    });


    if( $permitted->get()->count() >= 1 ) {
      return true;
    }


    // check if user has permit to the group his in
    $permitted = $user->groups()->first()->permits()->where(function($q) use($module_method){
      $q->where('module','*');
      $q->where($module_method, 1);
    })->orWhere(function($q) use($module_name,$module_method){
      $q->where('module',$module_name);
      $q->where($module_method, 1);
    });


    if( $permitted->get()->count() >= 1 ) {
      return true;
    }

    return false;
  }



  public static function getModules() {
    $modules = [];
    foreach (\Route::getRoutes()->getRoutes() as $route)
    {
      $action = $route->getAction();
      $module = explode(".",$route->getName());
      if( $module[0] == 'module' ) {
        if( !isset($modules[ $module[1] ]) ) {
          $modules[ $module[1] ][] = $module[2];
        } else {
          if( !in_array($module[2], $modules[ $module[1] ]) ) {
            $modules[ $module[1] ][] = $module[2];
          }
        }
      }
    }
    return $modules;
  }

  public static function getUser(){
    return self::$user;
  }
}





function usermeta($user_id, $metakey){
  $user = \Modules\Admin\Entities\User::find($user_id);
  if( !$user ){ return false; }

  return $user->meta()->where('metakey',$metakey)->first() ? $user->meta()->where('metakey',$metakey)->first()->metavalue : false;
}