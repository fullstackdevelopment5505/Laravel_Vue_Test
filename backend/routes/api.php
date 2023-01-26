<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostResponseController;

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
// });Route::apiResource('/employee', 'EmployeeController')->middleware('auth:api');
Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'post'], function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
    });
    Route::group(['prefix' => 'response'], function () {
        Route::get('/{id}', [PostResponseController::class, 'index']);
        Route::post('/{id}', [PostResponseController::class, 'store']);
    });
    
});
Route::middleware('api')->group(function () {
    Route::post('/register', [UserAuthController::class, 'register']);
    Route::post('/login', [UserAuthController::class, 'login']);
});


