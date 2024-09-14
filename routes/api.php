<?php

use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// sanctumでtokenが有効時のみアクセス可能
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post("logout", [UserController::class, 'logout']);
    Route::get("top", [UserController::class, 'top']);
});
Route::post('mail', [MailController::class, 'send']);
Route::post("login", [UserController::class, 'index']);
