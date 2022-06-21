<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PassportAuthController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

// category api's
Route::get('/get-categories/{user_id}', [CategoryController::class, 'get']);
Route::post('/store-categories', [CategoryController::class, 'store']);
Route::get('/get-category/{id}', [CategoryController::class, 'get_category_by_id']);
Route::post('/update-category/{id}', [CategoryController::class, 'update']);

// category api's
Route::get('/get-tasks/{user_id}', [TaskController::class, 'get']);
Route::post('/store-tasks', [TaskController::class, 'store']);
Route::get('/get-task/{id}', [TaskController::class, 'get_task_by_id']);
Route::post('/update-task/{id}', [TaskController::class, 'update']);