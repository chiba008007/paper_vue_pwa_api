<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\adminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('mail', [MailController::class, 'send']);
Route::get('admin/login', [adminController::class, 'login']);
Route::post('admin/login', [adminController::class, 'logined']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    // Route::get('/list', function () {
    //     return view('welcome');
    // });
    Route::get('list', [adminController::class, 'list']);

});
