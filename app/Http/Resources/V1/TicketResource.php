<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class TicketResource extends JsonResource
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
            'type' => 'ticket',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->when(
                    $request->routeIs('tickets.show'),
                    $this->description
                ),
                'status' => $this->status,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at
            ],
            'relationship' => [
                'author' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
                        'self' => route('users.show',  ['user' => $this->user_id])
                    ]
                ]
            ],
            'includes' =>
            new UserResource($this->whenLoaded('user')),
            'links' => [
                'self' => route('tickets.show',  ['ticket' => $this->id])
            ]
        ];
    }
}
