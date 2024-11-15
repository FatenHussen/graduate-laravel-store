<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'new_password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'new_password.required' => __('custom.new_password.required'),
            'new_password.string' => __('custom.new_password.string'),
            'new_password.min' => __('custom.new_password.min'),
            'new_password.confirmed' => __('custom.new_password.confirmed'),
        ];
    }

}