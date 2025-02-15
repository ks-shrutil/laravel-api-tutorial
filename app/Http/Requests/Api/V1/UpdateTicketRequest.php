<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends BaseTicketRequest
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
        return $rules = [
            'data.attributes.title' => 'sometimes|string',
            'data.attributes.description' => 'sometimes|string',
            'data.attributes.status' => 'sometimes|string|in:A,C,H,X',
            'data.relationships.author.data.id' => 'prohibited'
        ];

        if (Auth::user()->tokenCan(Abilities::UpdateOwnTicket)) {
            $rules['data.relationships.author.data.id'] = 'sometimes|integer';
        }

        return $rules;
    }
}
