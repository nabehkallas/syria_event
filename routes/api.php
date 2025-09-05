<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;

use App\Http\Controllers\Api\Admin\EventController as AdminEventController;
use App\Http\Controllers\Api\Admin\UserController as AdminUserController;
use App\Http\Controllers\Api\Publisher\PublisherEventController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{id}', [EventController::class, 'show']);

Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::apiResource('events', AdminEventController::class);
    Route::apiResource('users', AdminUserController::class);
});

Route::middleware(['auth:sanctum', 'publisher'])->prefix('publisher')->name('publisher.')->group(function () {
    Route::post('events', [PublisherEventController::class, 'store'])->name('events.store');
    Route::put('events/{event}', [PublisherEventController::class, 'update'])->name('events.update');
});
