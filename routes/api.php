<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\UserPositionController;
use Illuminate\Support\Facades\Route;

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

Route::post('login', LoginController::class)->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', LogoutController::class)->name('logout');
    Route::resource('user-position', UserPositionController::class)->except(['create', 'edit']);
});
