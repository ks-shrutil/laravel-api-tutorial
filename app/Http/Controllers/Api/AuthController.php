<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{

    use ApiResponses;

    /**
     * Undocumented function
     *
     * @param LoginUserRequest $request
     * @return void
     */
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error('Invalid credentials', 401);
        }

        return $this->ok(
            'Authenticated',
            [
                'token' => $user->createToken(
                    'API token for ' . $user->email,
                    ['*'],
                    now()->addMonth()
                )->plainTextToken
            ]
        );
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->ok('');
    }
}
