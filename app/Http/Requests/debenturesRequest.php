<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class debenturesRequest extends FormRequest
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
         'paid_price'=>'required',
         'payment_type'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'paid_price.required'=>'المبلغ مطلوب',
        'payment_type.required'=>'نوع الدفع مطلوب',
        ];
    }
}
