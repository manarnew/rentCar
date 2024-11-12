<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarExpensesRequest extends FormRequest
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
         'car_id'=>'required',
         'supplier'=>'required',
         'price'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'car_id.required'=>'رقم اللوحة مطلوب',
        'supplier.required'=>'اسم المورد مطلوب',
        'price.required'=>'سعر  المصروف مطلوب',
        ];
    }
}
