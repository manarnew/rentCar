<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminPanelSettingRequestApi extends FormRequest
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
            'Inctance_id' => 'required',
            'access_token' => 'required',
            'message' => 'required',
             'notfication_number' => 'required',
               'country_key' => 'required',
        ];
        
    }

  
}
