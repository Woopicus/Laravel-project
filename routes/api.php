<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

Route::get('/messages', [MessageController::class, 'getMessages']);
Route::get('/messages/{messageId}', [MessageController::class, 'getMessage']);
Route::post('/messages', [MessageController::class, 'createMessage']);
Route::put('/messages/{messageId}', [MessageController::class, 'updateMessage']);
Route::delete('/messages/{messageId}', [MessageController::class, 'removeMessage']);
