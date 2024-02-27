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
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::post('register',[UserAuthController::class,'register']);
Route::post('login',[UserAuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {
    //Route::get('/token-left', [UserAuthController::class, 'tokenExpirationTimeLeft']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::apiResource('authors',AuthorController::class);
    Route::apiResource('books',BookController::class);
});
  
/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
    Route::get('/token-left', [UserAuthController::class, 'tokenExpirationTimeLeft']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::apiResource('authors',AuthorController::class);
    return $request->user();
});*/
