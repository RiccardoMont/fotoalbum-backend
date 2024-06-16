<?php

use App\Http\Controllers\Api\BestShootController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PhotoController;
use App\Http\Controllers\Api\LeadController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('photos', [PhotoController::class, 'index']);
Route::get('photos/{photo}', [PhotoController::class, 'show']);

Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/filter', [CategoryController::class, 'category_filter']);

Route::get('bestshoots/highlighted', [BestShootController::class, 'index']);

Route::post('contacts', [LeadController::class, 'store']);