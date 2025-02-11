<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * Summary of login
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function login(){
        return response()->json([
            'message' => 'Hello login!'
        ], 200);
    }
}
