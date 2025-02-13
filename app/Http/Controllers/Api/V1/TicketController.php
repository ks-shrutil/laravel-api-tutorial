<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TicketController extends ApiController
{
    /**
     * Undocumented function
     *
     * @param Ticket $ticket
     * @return void
     */
    public function index(TicketFilter $filters)
    {

        return TicketResource::collection(Ticket::filter($filters)->paginate());
    }



    public function store(StoreTicketRequest $request)
    {
        try {
            $user = User::find($request->input('data.relationships.author.data.id'));
        } catch (ModelNotFoundException $exception) {
            return $this->ok('User not found', [
                'error' => 'The provided user id does not exists'
            ]);
        }

        $model = [
            'title' => $request->input('data.attributes.title'),
            'description' => $request->input('data.attributes.description'),
            'status' => $request->input('data.attributes.status'),
            'user_id' => $request->input('data.relationships.author.data.id')
        ];

        return Ticket::create($model);
    }




    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }





    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        //
    }



    public function destroy(Ticket $ticket)
    {
        $ticket->destroy();
    }
}
