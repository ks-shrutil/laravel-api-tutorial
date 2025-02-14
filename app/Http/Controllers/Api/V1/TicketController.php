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
     * Undocumented function
     *
     * @param TicketFilter $filters
     * @return void
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
        try {

            //policy
            $this->isAble('store', Ticket::class);

            return new TicketResource(Ticket::create($request->mappedAttributes()));
        } catch (ModelNotFoundException $exception) {
            return $this->error('You are not authorized to update the resource', 401);
        }
    }




    /**
     * Undocumented function
     *
     * @param [type] $ticket_id
     * @return void
     */
    public function show($ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            if ($this->include('author')) {
                return new TicketResource($ticket->load('user'));
            }
            return new TicketResource($ticket);
        } catch (AuthorizationException $exception) {
            return $this->error('Ticket cannot be found', 404);
        }
    }



    public function update(UpdateTicketRequest $request, $ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);

            $this->isAble('update', $ticket);


            $ticket->update($request->mappedAttributes());

            return new TicketResource($ticket);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket cannot be found.', 404);
        }
    }




    /**
     * Undocumented function
     *
     * @param ReplaceTicketRequest $request
     * @param [type] $ticket_id
     * @return void
     */
    public function replace(ReplaceTicketRequest $request, $ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);

            //policy
            $this->isAble('replace', null);

            $ticket->update($request->mappedAttributes());

            return new TicketResource($ticket);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket cannot be found.', 404);
        }
    }




    /**
     * Undocumented function
     *
     * @param [type] $ticket_id
     * @return void
     */
    public function destroy($ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            //policy
            $this->isAble('delete', null);

            $ticket->delete();

            return $this->ok('Ticket successfully deleted');
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket not found', 404);
        }
    }
}
