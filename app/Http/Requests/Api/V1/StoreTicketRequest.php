<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\FuncCall;

class StoreTicketRequest extends BaseTicketRequest
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
    public function rules()
    {
        return $rules = [
            'data.attributes.title' => 'sometimes|string',
            'data.attributes.description' => 'sometimes|string',
            'data.attributes.status' => 'sometimes|string|in:A,C,H,X',
            'data.relationships.author.data.id' => 'required|integer|exists:users,id'
        ];

        $user = $this->user();

        if($this->routeIs('tickets.store')){
           if($user->tokenCan(Abilities::CreateOwnTicket)){
                $rules['data.relationships.author.data.id'] .= '|size:' . $user->id;
           }
        }

        return $rules;
    }



}
