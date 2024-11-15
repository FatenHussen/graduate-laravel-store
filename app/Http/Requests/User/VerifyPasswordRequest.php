<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class VerifyPasswordRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => __('custom.email.required'),
            'email.email' => __('custom.email.email'),
            'email.exists' => __('custom.email.exists'),

            'code.required' => __('custom.code.required'),
            'code.string' => __('custom.code.string'),
        ];
    }

}