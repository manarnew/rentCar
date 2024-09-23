<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class carRequest extends FormRequest
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
         'plate_number'=>'required',
         'car_color'=>'required',
         'type_id'=>'required',
         'car_modals_id'=>'required',
         'full_insurance'=>'required',
         'third_party'=>'required',
         'full_cover'=>'required',
         'UAE'=>'required',
         'oman'=>'required',
         'km_number'=>'required',
         'daily_rent_price'=>'required',
         'hourly_rent_price'=>'required',
         'km_rent_price'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'daily_rent_price.required'=>'  سعر الاجار اليومي  مطلوب',
        'hourly_rent_price.required'=>'  سعر الاجار بساعة مطلوب',
        'km_rent_price.required'=>'  سعر الاجار بالكيلو مطلوب',
        'plate_number.required'=>'  رقم اللوحة مطلوب',
        'car_color.required'=>'  لون السيارة مطلوب',
        'type_id.required'=>'  نوع السيارة مطلوب',
        'car_modals_id.required'=>'  موديل السيارة مطلوب',
        'full_insurance.required'=>' حالة  تامين السيارة مطلوب',
        'full_cover.required'=>' حالة  تغطية شامله مطلوب',
        'third_party.required'=>' حالة طرف ثالث مطلوب',
        'UAE.required'=>' حالة الامارات العربية المتحدة مطلوب',
        'oman.required'=>' حالة عمان مطلوب',
        'km_number.required'=>'  عدد الكيلومترات الحالي مطلوب',
        ];
    }
}
