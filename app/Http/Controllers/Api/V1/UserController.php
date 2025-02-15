<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Api\V1\ReplaceUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Http\Filters\V1\AuthorFilter;
use App\Policies\V1\UserPolicy;
use App\Models\User;

class UserController extends ApiController
{
    protected $policyClass = UserPolicy::class;
    /**
     * Undocumented function
     *
     * @param AuthorFilter $filters
     * @return void
     */
    public function index(AuthorFilter $filters)
    {

        return UserResource::collection(
            User::filter($filters)->paginate()
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
        try {

            //policy
            $this->isAble('store', User::class);

            return new UserResource(User::create($request->mappedAttributes()));
        } catch (AuthorizationException $ex) {
            return $this->error('You are not authorized to create the resource', 401);
        }
    }



    /**
     * Undocumented function
     *
     * @param User $author
     * @return void
     */
    public function show(User $user)
    {
        if ($this->include('tickets')) {
            return new UserResource($user->load('tickets'));
        }

        return new UserResource($user);
    }




    public function update(UpdateUserRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);

            $this->isAble('update', $user);


            $user->update($request->mappedAttributes());

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Ticket cannot be found.', 404);
        } catch (AuthorizationException $ex) {
            return $this->error('You are not authorized to update the resource', 401);
        }
    }



    public function replace(ReplaceUserRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);

            //policy
            $this->isAble('replace', null);

            $user->update($request->mappedAttributes());

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            return $this->error('User cannot be found.', 404);
        }
    }


    public function destroy($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            //policy
            $this->isAble('delete', null);

            $user->delete();

            return $this->ok('User successfully deleted');
        } catch (ModelNotFoundException $exception) {
            return $this->error('User not found', 404);
        }
    }
}
