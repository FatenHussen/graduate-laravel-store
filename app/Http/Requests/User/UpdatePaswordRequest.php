<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdatePaswordRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => __('custom.old_password.required'),
            'old_password.string' => __('custom.old_password.string'),
            'old_password.min' => __('custom.old_password.min'),

            'new_password.required' => __('custom.new_password.required'),
            'new_password.string' => __('custom.new_password.string'),
            'new_password.min' => __('custom.new_password.min'),
        ];
    }

}