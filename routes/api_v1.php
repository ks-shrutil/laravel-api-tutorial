<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\TicketController;
use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::apiResource('tickets', TicketController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
