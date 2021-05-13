<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('users', [UserController::class, 'getUsers']);
Route::get('user-detail/{id}', [UserController::class, 'getUserDetails']);
Route::post('users', [UserController::class, 'storeUser']);
Route::put('users', [UserController::class, 'updateUser']);
Route::delete('users', [UserController::class, 'deleteUser']);


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
