<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HotelController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Category
Route::get('/category', [CategoryController::class,'index']);
Route::post('/category/create', [CategoryController::class, 'store']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

//Hotel
Route::get('/hotel',[HotelController::class,'index']);
Route::post('/hotel/create', [HotelController::class, 'store']);
Route::delete('/hotel/{id}', [HotelController::class, 'destroy']);
Route::get('/hotel/edit/{id}', [HotelController::class, 'edit']);
Route::post('/hotel/update/{id}', [HotelController::class, 'update']);

Route::post('/login', [AccountController::class, 'login']);
