<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LayoutController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    //Layout
    Route::get('/', [LayoutController::class, 'index'])->name('dashboard');

    //Category
    Route::get('/category', [CategoryController::class, 'viewList'])->name('home');
    Route::get('/category/create', [CategoryController::class, 'viewCreate'])->name('viewCreate');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');

    //Hotel
    Route::get('/hotel', [HotelController::class, 'viewHotel'])->name('hotel');
    Route::get('/hotel/create', [HotelController::class, 'viewCreate'])->name('create_hotel');
    Route::get('/hotel/edit/{id}', [HotelController::class, 'edit'])->name('hotel_edit');
    Route::get('/hotel/export', [HotelController::class, 'export']);
    Route::get('/hotel/export-hotels/{category}', [HotelController::class, 'exportHotels'])->name('export.hotels');
    Route::post('/hotel/importExcel', [HotelController::class, 'importExcelCSV']);
    Route::get('/hotel/excel-csv-file', [HotelController::class, 'indexExcelCSV']);
});

// Account
Route::get('/login', [AccountController::class, 'index'])->name('login');
Route::post('/login', [AccountController::class, 'login']);
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
Route::get('/register', [AccountController::class, 'indexRegister'])->name('register');
Route::post('/register', [AccountController::class, 'register']);
