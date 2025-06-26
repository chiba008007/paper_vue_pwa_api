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
    Route::post('editUser', [UserController::class, 'editUser']);
    Route::get('getEditUser', [UserController::class, 'getEditUser']);
    Route::post('editUserStatus', [UserController::class, 'editUserStatus']);
    Route::post('setRead', [UserController::class, 'setRead']);
    Route::get('getRead', [UserController::class, 'getRead']);
});


Route::post('mail', [MailController::class, 'send']);
Route::post('sameMail', [MailController::class, 'sameMail']);
Route::post("login", [UserController::class, 'index']);
Route::post("upload", [UserController::class, 'upload']);
Route::get("top", [UserController::class, 'top']);
Route::post("setRegist", [UserController::class, 'setRegist']);
Route::post("setRegistData", [UserController::class, 'setRegistData']);
Route::post("getRegistData", [UserController::class, 'getRegistData']);
Route::post("getRegistedUserData", [UserController::class, 'getRegistedUserData']);
Route::post("forget", [UserController::class, 'forget']);
Route::post("forgetForm", [UserController::class, 'forgetForm']);
Route::get("status", [UserController::class, 'status']);
