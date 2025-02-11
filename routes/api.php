<?php

use App\Http\Controllers\AuthController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/tickets', function(){
    return Ticket::all();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
