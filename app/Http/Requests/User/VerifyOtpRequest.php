<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class VerifyOtpRequest extends BaseRequest
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

            'device_id.required' => __('custom.device_id.required'),
            'device_id.string' => __('custom.device_id.string'),
            'device_id.unique' => __('custom.device_id.unique'),
        ];
    }

}
