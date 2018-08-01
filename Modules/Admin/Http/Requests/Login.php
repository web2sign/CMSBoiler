<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Admin\Entities\User;
use Modules\Admin\Entities\Usession;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Validation\Factory as ValidationFactory;

use Route;

class Login extends FormRequest
{



  public function __construct(ValidationFactory $validationFactory, Hasher $hasher){

    $validationFactory->extend(
      'username',
      function($attribute, $value, $parameters) use($hasher){

        if( $session_key = request()->session()->get('session_key') ) {
          $session = Usession::where('session_key','=',$session_key)->first();

          if( !$session  || $session->session_type != 'admin') {
            return false;
          }

        }

        $user = User::with('groups','groups.permits','permits')->where('username',request()->get('username'))->first();
        

        if( !$user ) {
          return false;
        }
        if( !$hasher->check( request()->get('password'), $user->password ) ) {
          return false;
        }


        /* generate key once login success */
        $token = bcrypt(env('APP_KEY') . '-' . time());
        request()->request->add(['session_key'=>$token,'user'=>$user]);

        return true;

      },
      'Access denied!'
    );


  }


  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'username' => 'required|username',
      'password' => 'required',
    ];
  }




  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }
}
