<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class AuthorTicketsController extends ApiController
{

    /**
     * Undocumented function
     *
     * @param [type] $author_id
     * @param TicketFilter $filters
     * @return void
     */
    public function index($author_id, TicketFilter $filters)
    {
        return TicketResource::collection(
            Ticket::where('user_id', $author_id)->filter($filters)->paginate()
        );
    }


    /**
     * Undocumented function
     *
     * @param [type] $author_id
     * @param StoreTicketRequest $request
     * @return void
     */
    public function store($author_id, StoreTicketRequest $request)
    {
        return Ticket::create($request->mappedAttributes());
    }



    /**
     * Undocumented function
     *
     * @param ReplaceTicketRequest $request
     * @param [type] $author_id
     * @param [type] $ticket_id
     * @return void
     */
    public function replace(ReplaceTicketRequest $request, $author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);

            if ($ticket->user_id == $author_id) {




                $ticket->update($request->mappedAttributes());
                return new TicketResource($ticket);
            }
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket cannot be found.', 404);
        }
    }




    public function update(UpdateTicketRequest $request, $author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);

            if ($ticket->user_id == $author_id) {

                $ticket->update($request->mappedAttributes());
                return new TicketResource($ticket);
            }
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket cannot be found.', 404);
        }
    }





    /**
     * Undocumented function
     *
     * @param [type] $author_id
     * @param [type] $ticket_id
     * @return void
     */
    public function destroy($author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::findOrFail($ticket_id);
            if ($ticket->user_id == $author_id) {
                $ticket->delete();

                return $this->ok('Ticket successfully deleted.');
            }
            return $this->error('Ticket cannot found.', 404);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket not found', 404);
        }
    }
}
