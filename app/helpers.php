<?php
use Modules\Admin\Entities\Usession, Carbon\Carbon, Request, Route;

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


  public static function hasAccess(){
    $user = self::$user;
    $current_route = Request::route()->getName();
    $module = explode(".", $current_route);
    
    // if route is not module
    if( !isset($module[0]) || $module[0] != 'module' ) {
      return true;
    }

    $module_type = $module[1];
    $module_name = $module[2];
    $module_method = $module[3];


    // check if user has permit itself
    $permitted = $user->permits()->where(function($q) use($module_method){
      $q->where('module','*');
      $q->where($module_method, 1);
    })->orWhere(function($q) use($module_name,$module_method){
      $q->where('module',$module_name);
      $q->where($module_method, 1);
    });


    if( $permitted->get()->count() ) {
      return true;
    }

    // check if user has permit to the group his in
    $permitted = $user->whereHas('groups.permits',function($q) use($module_name,$module_method){
      $q->where(function($q) use($module_method){
        $q->where('module','*');
        $q->where($module_method, 1);
      })->orWhere(function($q) use($module_name,$module_method){
        $q->where('module',$module_name);
        $q->where($module_method, 1);
      });
    });//->where('permits_count'>=1);

    if( $permitted->get()->count() ) {
      return true;
    }

    return false;
  }

}