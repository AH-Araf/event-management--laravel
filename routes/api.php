<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\EventController;

// API version 1
Route::prefix('v1')->group(function () {
    Route::apiResource('events', EventController::class);
    Route::get('events/category/{category}', [EventController::class, 'getEventsByCategory'])->name('events.category');
});
