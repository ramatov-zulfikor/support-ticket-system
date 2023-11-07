<?php

use Illuminate\Http\Request;
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

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::get('tags', 'TagController@index');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', 'AuthController@logout');
});