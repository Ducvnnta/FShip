<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiValidationRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns|max:100',
            'password' => 'required',
            // 'device_id' => 'required',
            // 'device_token' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => "Email là bắt buộc",
            'email.max' => "Email tối thiểu 100 kí tự",
            'password.required' => "Password là bắt buộc",
            // 'device_id.required' => trans('validation.required'),
            // 'device_token.required' => trans('validation.required'),
        ];
    }

    /**
     * getAttributes
     *
     * @return void
     */
    public function getAttributes() {
        return $this->validated();
    }
}
