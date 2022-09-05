<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StoreUserRequest extends FormRequest
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
            'user_name' => 'required|string|min:2|max:255',
            'phone_number' => 'required|string|min:2|max:255',
            'password' => 'required|string|min:2|max:255',
            "fa_first_name" => 'nullable|string|min:2|max:255',
            "fa_last_name" => 'nullable|string|min:2|max:255',
            "en_first_name" => 'nullable|string|min:2|max:255',
            "en_last_name" => 'nullable|string|min:2|max:255',
            "email" => 'nullable|string|min:2|max:255'

        ];
    }
}
