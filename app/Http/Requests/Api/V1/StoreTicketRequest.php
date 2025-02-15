<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Auth;
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
        $isTicketController = $this->routeIs('tickets.store');
        $authorIdAttr = $isTicketController ? 'data.relationships.author.data.id' : 'author';
        $user = Auth::user();
        $authorRule = 'required|integer|exists:users,id';

        return $rules = [
            'data' => 'required|array',
            'data.attributes' => 'required|array',
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|string|in:A,C,H,X',
        ];

        if ($isTicketController) {
            $rules['data.relationships'] = 'required|array';
            $rules['data.relationships.author'] = 'required|array';
            $rules['data.relationships.author.data'] = 'required|array';
        }

        $rules[$authorIdAttr] = $authorRule . '|size:' . $user->id;

        $user = $this->user();


        if ($user->tokenCan(Abilities::CreateTicket)) {
            $rules[$authorIdAttr] =  $authorRule;
        }


        return $rules;
    }


    protected function prepareForValidation()
    {
        if ($this->routeIs('authors.tickets.store')) {
            $this->merge([
                'author' => $this->route('author')
            ]);
        }
    }


    public function bodyParameters()
    {
        $documentation =  [
            'data.attributes.title' => [
                'description' => "The ticket's title(method)",
                'example' => 'No-example'
            ],
            'data.attributes.description' => [
                'description' => "The ticket's description",
                'example' => 'No-example'
            ],
            'data.attributes.status' => [
                'description' => "The ticket's status",
                'example' => 'No-example'
            ]
        ];

        if($this->routeIs('tickets.store')){
            $documentation['data.relationships.author.data.id'] = [
                'description' => 'The author assigned to the ticket.',
                'example' => 'No-example'
            ];
        }else{
            $documentation['author'] = [
                'description' => 'The author assigned to the ticket.',
                'example' => 'No-example'
            ];
        }

        return $documentation;
    }
}
