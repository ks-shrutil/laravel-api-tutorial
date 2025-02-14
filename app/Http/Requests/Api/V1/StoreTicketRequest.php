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
        $authorIdAttr = $this->routeIs('tickets.store') ? 'data.relationships.author.data.id' : 'author';

        return $rules = [
            'data.attributes.title' => 'sometimes|string',
            'data.attributes.description' => 'sometimes|string',
            'data.attributes.status' => 'sometimes|string|in:A,C,H,X',
           $authorIdAttr => 'required|integer|exists:users,id'
        ];

        $user = $this->user();


        if ($user->tokenCan(Abilities::CreateOwnTicket)) {
            $rules[$authorIdAttr] .= '|size:' . $user->id;
        }


        return $rules;
    }


    protected function prepareForValidation()
    {
        if($this->routeIs('authors.tickets.store')){
            $this->merge([
                'author' => $this->route('author')
            ]);  
        }
    }
}
