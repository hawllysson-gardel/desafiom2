<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\CityController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['prefix' => 'city'], function () {
    Route::get('/{id}', [CityController::class, 'get'])->where('id', '[0-9]+')->name('city');
    Route::get('/', [CityController::class, 'search'])->name('search-cities');
    Route::post('/', [CityController::class, 'store'])->name('store-city');
    Route::put('/{id}', [CityController::class, 'update'])->where('id', '[0-9]+')->name('update-city');
    Route::delete('/{id}', [CityController::class, 'destroy'])->where('id', '[0-9]+')->name('delete-city');
    Route::delete('/force/{id}', [CityController::class, 'forceDestroy'])->where('id', '[0-9]+')->name('force-delete-city');
    Route::post('/{id}', [CityController::class, 'restore'])->name('restore-city');
});

Route::group(['prefix' => 'product'], function () {
    Route::get('/{id}', [ProductController::class, 'get'])->where('id', '[0-9]+')->name('product');
    Route::get('/', [ProductController::class, 'search'])->name('search-products');
    Route::post('/', [ProductController::class, 'store'])->name('store-product');
    Route::put('/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+')->name('update-product');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->where('id', '[0-9]+')->name('delete-product');
    Route::delete('/force/{id}', [ProductController::class, 'forceDestroy'])->where('id', '[0-9]+')->name('force-delete-product');
    Route::post('/{id}', [ProductController::class, 'restore'])->name('restore-product');
});