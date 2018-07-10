<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Usession;
use Illuminate\Contracts\Hashing\Hasher;
use Route;

class LoginValidation extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'username' => 'required',
      'password' => 'required',
    ];
  }




  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(Hasher $hasher)
  {
    
    if( $session_key = $this->session()->get('session_key') ) {
      $session = Usession::where('session_key','=',$session_key)->first();

      if($session) {
        if( $session->session_type == 'admin' ) {
          return redirect()->to('admin')->send();
        } else {
          return redirect()->to('admin/login')->withErrors(['msg'=>'Access denied.'])->send();
        }
      }

    }

    $user = User::with('groups','groups.permits','permits')->where('username',$this->get('username'))->first();
    
    if( !$user ) {
      return redirect()->to('admin/login')->withErrors(['msg'=>'Access denied.'])->send();
    } elseif( !$hasher->check( $this->get('password'), $user->password ) ) {
      return redirect()->to('admin/login')->withErrors(['msg'=>'Access denied.'])->send();
    }


    /* generate key once login success */
    $token = bcrypt(env('APP_KEY') . '-' . time());
    $this->request->add(['session_key'=>$token,'user'=>$user]);

    return true;
  }
}
