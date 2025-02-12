<?php

use App\Http\Controllers\Api\V1\TicketController;
use App\Http\Controllers\Api\V1\AuthorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\V1\AuthorTicketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Ticket;


Route::middleware('auth:sanctum')->apiResource('tickets', TicketController::class);
Route::middleware('auth:sanctum')->apiResource('authors', AuthorsController::class);
Route::middleware('auth:sanctum')->apiResource('authors.tickets', AuthorTicketController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
