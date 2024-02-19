<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RatingController;

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

    
    Route::post('/recipes', [RecipeController::class, 'create']);
    Route::post('/recipes/{id}', [RecipeController::class, 'update']);
    Route::delete('/recipes/{id}', [RecipeController::class, 'delete']);

});


Route::get('/recipes/{id}', [RecipeController::class, 'getRecipe']);
Route::get('/recipes', [RecipeController::class, 'listRecipe']);

//Rate recipe

Route::post('/recipes/{id}/rating', [RatingController::class, 'rateRecipe']);






