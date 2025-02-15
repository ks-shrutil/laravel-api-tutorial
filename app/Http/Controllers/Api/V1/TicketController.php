<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Http\Filters\V1\TicketFilter;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\V1\TicketPolicy;
use Illuminate\Auth\Access\AuthorizationException;

class TicketController extends ApiController
{

    protected $policyClass = TicketPolicy::class;




    /**
     *Create a Tickets
     *
     * Creates a new Ticket. Users can only create tickets fot themselves. Manager can create tickets for any user.
     * 
     *@group Managing Tickets
     *
     * 
     */
    public function index(TicketFilter $filters)
    {

        return TicketResource::collection(Ticket::filter($filters)->paginate());
    }



    /**
     * Undocumented function
     *
     * @param StoreTicketRequest $request
     * @return void
     */
    public function store(StoreTicketRequest $request)
    {
        //policy
        if ($this->isAble('store', Ticket::class)) {

            return new TicketResource(Ticket::create($request->mappedAttributes()));
        }

        return $this->notAuthorized('You are not authorized to store the resource');
    }



    public function show(Ticket $ticket)
    {

        if ($this->include('author')) {
            return new TicketResource($ticket->load('user'));
        }
        return new TicketResource($ticket);
    }



    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {


        if ($this->isAble('update', $ticket)) {
            $ticket->update($request->mappedAttributes());

            return new TicketResource($ticket);
        }
        return $this->notAuthorized('You are not authorized to update the resource');
    }


    /**
     * Undocumented function
     *
     * @param ReplaceTicketRequest $request
     * @param [type] $ticket_id
     * @return void
     */
    public function replace(ReplaceTicketRequest $request, Ticket $ticket)
    {

        if ($this->isAble('replace', null)) {
            $ticket->update($request->mappedAttributes());

            return new TicketResource($ticket);
        }
        return $this->notAuthorized('You are not authorized to update that resource');
    }


    /**
     * Undocumented function
     *
     * @param [type] $ticket_id
     * @return void
     */
    public function destroy(Ticket $ticket)
    {
        if ($this->isAble('delete', null)) {

            $ticket->delete();

            return $this->ok('Ticket successfully deleted');
        }

        return $this->notAuthorized('You are not authorized to delete that user.');
    }
}
