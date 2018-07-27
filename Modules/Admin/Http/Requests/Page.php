<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Page extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      //dd(request('id',NULL));
        return [
          'title' => 'required|min:6',
          'content' => 'required|min:10',
          'slug' => (request('id') ? 'required|unique:pages,slug,'.request('id').',id,post_type,'.$this->__post_type : 'required|unique:pages,slug,NULL,id,post_type,'.$this->__post_type ),
          'featured_image' => 'nullable|image'
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
