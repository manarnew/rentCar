<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class communiqueRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
         'communique_number'=>'required',
         'communique_place'=>'required',
         'date'=>'required',
        ];
    }

    public function messages()
    {
        return [
      'communique_number.required'=>'  رقم البلاغ مطلوب',
'date.required'=>'  تاريخ  البلاغ مطلوب',
'communique_place.required'=>'  مكان البلاغ  مطلوب',
        ];
    }
}
