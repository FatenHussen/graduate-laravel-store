<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Allow all users to filter categories

        // Only allow admin users to perform create, update, and delete actions
        // if ($this->isMethod('get')) {
        //     return true; // Allow `getAll` and `getById` for all users
        // }

        // Allow only admins for create, update, delete
        // return auth()->user() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'error' => $validator->errors()->all()[0],
            ], 422)
        );
    }

    protected function passedValidation()
    {
        $validatedData = $this->validated();
        $this->replace($validatedData);
    }
}