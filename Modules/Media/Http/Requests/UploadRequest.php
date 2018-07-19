<?php

namespace Modules\Media\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
      return [
        'qqfile' => 'required|file|max:5120|mimes:jpeg,bmp,png,jpg,gif,pdf,doc,docx,xls,xlsx,zip,key,mp3,m4a,ogg,wav,avi,mp4.3gp' // 5mb
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

  public function messages(){
    return [
      'qqfile.required' => 'No file is selected.',
      'qqfile.file' => 'Invalid file.',
      'qqfile.max' => 'File exceeds 5120KB.'
    ];
  }

  protected function failedValidation(Validator $validator) { 
    throw new HttpResponseException(response()->json([
      'success' => false,
      'error' => $validator->errors()->first()
    ], 422)); 
  }
}
