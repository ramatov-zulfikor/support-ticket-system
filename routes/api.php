<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller('AuthController')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

Route::controller('TagController')->prefix('tags')->group(function () {
    Route::get('/', 'index');
    Route::get('find', 'find');
});

Route::controller('TicketController')->prefix('tickets')->group(function () {
    Route::get('/', 'index');
    Route::get('{ticket}', 'show');
});

Route::controller('TicketCommentController')->prefix('tickets/{ticket}/comments')->group(function () {
    Route::get('/', 'index');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller('AuthController')->group(function () {
        Route::post('logout', 'logout');
    });

    Route::controller('TicketController')->prefix('tickets')->group(function () {
        Route::post('/', 'store');
        Route::put('{ticket}', 'update');
        Route::delete('{ticket}', 'destroy');
        Route::post('{ticket}/like', 'like');
    });

    Route::controller('TicketCommentController')->prefix('tickets/{ticket}/comments')->group(function () {
        Route::post('/', 'store');
        Route::put('{comment}', 'update');
        Route::delete('{comment}', 'destroy');
    });
});
