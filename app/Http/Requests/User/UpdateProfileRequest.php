<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:3',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable|file',
            'city_id' => 'nullable|exists:cities,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => __('custom.name.string'),
            'name.min' => __('custom.name.min'),

            'email.email' => __('custom.email.email'),
            'email.unique' => __('custom.email.unique'),

            'password.string' => __('custom.password.string'),
            'password.min' => __('custom.password.min'),

            'image.file' => __('custom.image.file'),
            'logo.file' => __('custom.logo.file'),

            'city_id.exists' => __('custom.city_id.exists'),

            'fcm_token.nullable' => __('custom.fcm_token.nullable'),
        ];
    }

}