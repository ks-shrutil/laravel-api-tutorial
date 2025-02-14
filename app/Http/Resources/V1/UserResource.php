<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'isManager' => $this->is_manager,

                $this->mergeWhen($request->routeIs('authors.*'), [
                    'emailVerifiedAt' => $this->email_verified_at,
                    'createdAt' => $this->created_at,
                    'updatedAt' => $this->updated_at,

                ])
            ],

            'include' => TicketResource::collection($this->whenLoaded('tickets')),
            'links' => [
                'self' => route('authors.show',  ['author' => $this->id])
            ]
        ];
    }
}
