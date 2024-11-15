<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserLoginRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('custom.email.required'),
            'email.email' => __('custom.email.email'),
            // 'email.exists' => __('custom.email.exists'),

            'password.required' => __('custom.password.required'),
            'password.string' => __('custom.password.string'),
            'password.min' => __('custom.password.min'),

            'device_id.required' => __('custom.device_id.required'),
            'device_id.string' => __('custom.device_id.string'),
        ];
    }

}