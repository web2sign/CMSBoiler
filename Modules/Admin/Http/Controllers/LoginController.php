<?php

namespace Modules\Admin\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Usession;
use Modules\Admin\Http\Requests\LoginValidation as Requests;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function getLogin()
    {
      return view('admin::login');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function postLogin(Requests $request)
    {
      //dd( $request->all() );
      $request->session()->put(['session_key'=>$request->get('session_key')]);

      /* create session key */
      $user = $request->user;
      $user->sessions()->create([
        'session_key' => $request->get('session_key'),
        'session_type' => 'admin',
        'ip' => $request->ip(),
        'expired_at' => Carbon::now()->addDays(3)
      ]);
      
      return redirect()->to('admin/dashboard')->send();
    }
}
