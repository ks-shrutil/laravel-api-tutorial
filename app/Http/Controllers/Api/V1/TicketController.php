<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;

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
        //
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
        //
    }
}
