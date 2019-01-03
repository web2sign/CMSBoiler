<?php

namespace Modules\Group\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\DB;


class Group extends FormRequest
{

  public function __construct(ValidationFactory $validationFactory){
/*    $validationFactory->extend(
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
    );*/

  }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    { 
        return [
          'name' => 'required',
          'description' => 'required',

        ];
    }

    public function messages() {
      return [
        //'groups.required' => 'Must select a group.',
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
