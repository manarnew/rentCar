<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class customerRequest extends FormRequest
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
         'name'=>'required',
         'com_name'=>'required',
         'identity_number'=>'required',
         'phone'=>'required',
         'address'=>'required',
         'nationality'=>'required',
         'driver_license_number'=>'required',
         'driver_license_address'=>'required',
         'driver_license_release_date'=>'required',
         'driver_license_address_end_date'=>'required',
         'identity_release_date'=>'required',
         'identity_end_date'=>'required',
         'identity_address'=>'required',
         'word_address'=>'required',
        ];
    }

    public function messages()
    {
        return [
        'identity_release_date.required'=>'تاريخ  الاصدار مطلوب',
        'identity_end_date.required'=>'تاريخ الانتهاء مطلوب',
        'identity_address.required'=>'مكان الاستخراج مطلوب',
        'word_address.required'=>'مكان العميل مطلوب',
        'name.required'=>'اسم العميل مطلوب',
        'com_name.required'=>'اسم الشركة  مطلوب',
        'identity_number.required'=>'رقم الهوية مطلوب',
        'phone.required'=>'رقم الهاتف مطلوب',
        'address.required'=>'العنوان  مطلوب',
        'nationality.required'=>'الجنسية  مطلوب',
        'driver_license_number.required'=>'رقم رخصة القيادة مطلوب',
        'driver_license_address.required'=>'مكان اصدار رخصة القيادة مطلوب',
        'driver_license_release_date.required'=>'تاريخ اصدار رخصة القيادة مطلوب',
        'driver_license_address_end_date.required'=>'تاريخ انتهاء  رخصة مطلوب',
        ];
    }
}
