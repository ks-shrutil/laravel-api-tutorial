<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Models\User;
use App\Permissions\V1\Abilities;

class AuthController extends Controller
{

    use ApiResponses;

    /**
     * Login
     * 
     * Authenticates the user and returns the user's API token.
     * 
     * @unauthenticated
     * @group Authentication
     * @response 200{
     * "data": {
     *    "token": "5|kTMhd7W7H8DgzK401FVozMtoI0OaumukxwR1kCS77b9daea1"
     *},
     *"message": "Authenticated",
     *"status": 200
     *}
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error('User not found', 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return $this->error('Incorrect password', 401);
        }

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    Abilities::getAbilities($user),
                    now()->addMonth()
                )->plainTextToken
            ]
        );
    }

   
    /**
     * Logout
     * 
     * Signs out the user and destroy's the API token.
     * 
     * @group Authentication
     * @response 200
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}
