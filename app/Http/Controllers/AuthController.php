<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiLoginRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    use ApiResponses;

    /**
     * Summary of login
     * @param \App\Http\Requests\ApiLoginRequest $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(ApiLoginRequest $request) {
        return $this->ok($request->get('email'));
    }


    /**
     * Summary of register
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function register(){
        return $this->ok('register');
    }
}
