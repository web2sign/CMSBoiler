<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\DB;


class User extends FormRequest
{

  public function __construct(ValidationFactory $validationFactory){
    $validationFactory->extend(
      'multi_exists',
      function( $attr, $ids, $param ){
        if( count($param) < 1 ) {
          return true;
        }
        
        $group = DB::table($param[0])->whereIn('id',$ids);
        
        if( count($ids) > $group->count() ) {
          return false;
        }

        return true;

      },
      'Selected group does not exists.'
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
          'groups' => 'required|exists:groups,id',
          'email' => ( request('id') ? 'required|email|unique:users,email,'.request('id') : 'required|email|unique:users,email' ),
          'username' => ( request('id') ? 'required|unique:users,username,'.request('id') : 'required|unique:users,username' ),
          'password' => 'required|required_with:password_confirm|same:password_confirm|min:6',
          'password_confirm' => 'min:6',
        ];
    }

    public function messages() {
      return [
        'groups.required' => 'Must select a group.',
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
