<?php

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
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

// Route::group(['middleware' => 'auth:sanctum'], function() {
//   Route::post('/create', [FormController::class, 'create']);
//   Route::get('/edit/{item:id}', [FormController::class, 'edit']);
//   Route::get('/logout', [AuthController::class, 'logout']);  
// });

// Route::post('/login', [AuthController::class, 'login']);

Route::get('/', [FormController::class, 'index']);
Route::get('/{item:id}', [FormController::class, 'show']);
Route::post('/', [FormController::class, 'store']);
Route::put('/{item:id}', [FormController::class, 'update']);
Route::delete('/{item:id}', [FormController::class, 'destroy']);
