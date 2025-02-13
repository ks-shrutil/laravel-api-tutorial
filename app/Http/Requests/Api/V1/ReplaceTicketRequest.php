<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class ReplaceTicketRequest extends BaseTicketRequest
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
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|string|in:A,C,H,X',
            'data.relationships.author.data.id' => 'required|integer'
        ];


        return $rules;
    }



 
}
