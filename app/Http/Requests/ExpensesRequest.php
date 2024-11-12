<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpensesRequest extends FormRequest
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
         'expenses_type'=>'required',
         'price'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'expenses_type.required'=>'نوع تامصروف مطلوب',
        'price.required'=>'سعر  المصروف مطلوب',
        ];
    }
}
