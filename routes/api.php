<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


//Protected routes

Route::group(['middleware' => 'auth:sanctum','prefix' => 'user'], function() {

    
    Route::post('create', [RecipeController::class, 'create']);
    Route::post('update/{id}', [RecipeController::class, 'update']);
    Route::delete('delete/{id}', [RecipeController::class, 'delete']);

});


Route::get('getrecipe/{id}', [RecipeController::class, 'getRecipe']);
Route::get('listrecipe', [RecipeController::class, 'listRecipe']);






