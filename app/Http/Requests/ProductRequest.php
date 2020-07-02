<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
   public function rules()
   {
      return [
         'name' => 'required|min:2|unique:products,name'
      ];
   }

   /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
   public function messages()
   {
      return [
         'name.required' => 'Name is required',
         'name.unique'  => 'This product name is taken alredy!',
      ];
   }
}
