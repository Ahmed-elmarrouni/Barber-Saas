<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ReservationsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post("/register", [AuthController::class,"register"]);
Route::post("/login", [AuthController::class,"login"]);


// POSTS ROUTES
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get("/", [PostsController::class, 'index']);
        Route::get("/{id}", [PostsController::class, 'show']); // fetch post by id route
        Route::post("/", [PostsController::class, 'store']); // create new post route
        Route::put("/{id}", [PostsController::class, 'update']); // update  post by id route
        Route::delete("/{id}", [PostsController::class, 'destroy']); // Delete  post by id route

    });
});


//RESERVATIONS ROUTS
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('reservations')->group(function () {
        Route::get("/", [ReservationsController::class, 'index']);
        Route::get("/{id}", [ReservationsController::class, 'show']); // fetch reservation by id route
        Route::post("/", [ReservationsController::class, 'store']); // create new reservation route
        Route::put("/{id}", [ReservationsController::class, 'update']); // update  reservation by id route
        Route::delete("/{id}", [ReservationsController::class, 'destroy']); // Delete  reservation by id route
    });
});


