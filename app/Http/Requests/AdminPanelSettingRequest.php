<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPanelSettingRequest extends FormRequest
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
            'system_name' => 'required',
            'address' => 'required',
            'phone_one' => 'required',
            'address_two' => 'required',
            'tax_number' => 'required',
            'cr_number' => 'required',
            'intro' => 'required',
            'email' => 'required',
            'ar_contract' => 'required',
            'en_contract' => 'required',
              'number_of_km_mantince' => 'required',
        ];
    }

    public function messages()
    {
        return [
             'number_of_km_mantince.required' => 'عدد الكيلومترات لشعارات الصيانة مطلوب',
            'system_name.required' => 'اسم الشركة مطلوب',
            'email.required' => 'ايميل الشركة مطلوب',
            'address.required' => 'عنوان الشركة مطلوب',
            'phone_one.required' => 'هاتف الشركة مطلوب',
            'address_two.required' => 'عنوان الشركة مطلوب',
            'photo.required' => 'لوجو الشركة  مطلوب',
            'tax_number.required' => 'الرقم الضريبي للشركة  مطلوب',
            'cr_number.required' => 'رقم الشركة  مطلوب',
            'intro.required' => 'نبذة عن الشركة  مطلوب',
        ];
    }
}
