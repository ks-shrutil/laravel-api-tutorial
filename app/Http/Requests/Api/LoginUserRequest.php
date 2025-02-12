<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Undocumented function
     *
     * @return boolean
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
