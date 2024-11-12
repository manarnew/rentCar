<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractsRequest extends FormRequest
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
         'contract_type'=>'required',
         'contract_number'=>'required',
         'customer_id'=>'required',
         'contract_status'=>'required',
         'exist_date'=>'required',
         'exist_time'=>'required',
         'return_date'=>'required',
         'return_time'=>'required',
          'exist_km'=>'required',
         'payment_type'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'contract_type.required'=>'  نوع الحجز مطلوب',
        'payment_type.required'=>'  نوع الدفع مطلوب',
        'contract_number.required'=>'  العدد/اليوم للحجز مطلوب',
        'customer_id.required'=>'  اسم العميل مطلوب',
        'contract_status.required'=>'  حالة الحجز مطلوب',
        'exist_date.required'=>'  تاريخ المغادرة مطلوب',
        'exist_time.required'=>'  وقت المغادرة مطلوب',
        'return_date.required'=>'  تاريخ العودة مطلوب',
        'return_time.required'=>'  وقت العودة مطلوب',
        'exist_km.required'=>'  عدد الكيلومترات وقت المغادرة مطلوب  مطلوب'
        ];
    }
}
