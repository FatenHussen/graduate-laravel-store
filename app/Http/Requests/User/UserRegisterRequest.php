<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UserRegisterRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            // 'city_id' => 'required|exists:cities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('custom.name.required'),
            'name.string' => __('custom.name.string'),
            'name.min' => __('custom.name.min'),

            'email.required' => __('custom.email.required'),
            'email.email' => __('custom.email.email'),
            'email.unique' => __('custom.email.unique'),

            'password.required' => __('custom.password.required'),
            'password.string' => __('custom.password.string'),
            'password.min' => __('custom.password.min'),

            // 'city_id.required' => __('custom.city_id.required'),
            // 'city_id.exists' => __('custom.city_id.exists'),

            'device_id.required' => __('custom.device_id.required'),
            'device_id.string' => __('custom.device_id.string'),
            'device_id.unique' => __('custom.device_id.unique'),

            'fcm_token.nullable' => __('custom.fcm_token.nullable'),
        ];
    }

}