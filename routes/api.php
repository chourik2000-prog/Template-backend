<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('users')->controller(AuthController::class)->group(function (){
    Route::post('/register', 'create');
    Route::post('/login', 'login');
});

Route::prefix('users')->controller(UserController::class)->group(function (){
    Route::get('/', 'index');
    Route::put('/{id}', 'update');
    Route::delete('/{id}', 'destroy');
});
