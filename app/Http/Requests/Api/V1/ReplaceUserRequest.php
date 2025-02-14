<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class ReplaceUserRequest extends BaseUserRequest
{

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
        $rules = [
            'data.attributes.name' => 'required|string',
            'data.attributes.email' => 'required|email',
            'data.attributes.isManager' => 'required|boolean',
            'data.attributes.password' => 'required|string'
        ];


        return $rules;
    }
}
