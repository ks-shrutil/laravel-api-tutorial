<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Filters\V1\AuthorFilter;
use App\Models\User;

class AuthorsController extends ApiController
{
    /**
     * Undocumented function
     *
     * @param AuthorFilter $filters
     * @return void
     */
    public function index(AuthorFilter $filters)
    {

        return UserResource::collection(
            User::select('users.*')
            ->join('tickets', 'users.id', '=', 'tickets.user_id')
            ->filters($filters)
            ->distinct()
            ->paginate()
        );
    }



    /**
     * Undocumented function
     *
     * @param StoreUserRequest $request
     * @return void
     */
    public function store(StoreUserRequest $request)
    {
        //
    }



    /**
     * Undocumented function
     *
     * @param User $author
     * @return void
     */
    public function show(User $author)
    {
        if ($this->include('tickets')) {
            return new UserResource($author->load('tickets'));
        }

        return new UserResource($author);
    }




    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }


    public function destroy(User $user)
    {
        //
    }
}
