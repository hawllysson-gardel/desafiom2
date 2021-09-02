<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CityController;
use App\Http\Controllers\CityGroupController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'city'], function () {
    Route::get('/{id}', [CityController::class, 'get'])->where('id', '[0-9]+')->name('city');
    Route::get('/', [CityController::class, 'search'])->name('search-cities');
    Route::post('/', [CityController::class, 'store'])->name('store-city');
    Route::put('/{id}', [CityController::class, 'update'])->where('id', '[0-9]+')->name('update-city');
    Route::delete('/{id}', [CityController::class, 'destroy'])->where('id', '[0-9]+')->name('delete-city');
    Route::delete('/force/{id}', [CityController::class, 'forceDestroy'])->where('id', '[0-9]+')->name('force-delete-city');
    Route::post('/{id}', [CityController::class, 'restore'])->name('restore-city');
});

Route::group(['prefix' => 'city-group'], function () {
    Route::get('/{id}', [CityGroupController::class, 'get'])->where('id', '[0-9]+')->name('city-group');
    Route::get('/', [CityGroupController::class, 'search'])->name('search-city-groups');
    Route::post('/', [CityGroupController::class, 'store'])->name('store-city-group');
    Route::put('/{id}', [CityGroupController::class, 'update'])->where('id', '[0-9]+')->name('update-city-group');
    Route::delete('/{id}', [CityGroupController::class, 'destroy'])->where('id', '[0-9]+')->name('delete-city-group');
    Route::delete('/force/{id}', [CityGroupController::class, 'forceDestroy'])->where('id', '[0-9]+')->name('force-delete-city-group');
    Route::post('/{id}', [CityGroupController::class, 'restore'])->name('restore-city-group');
});

Route::group(['prefix' => 'campaign'], function () {
    Route::get('/{id}', [CampaignController::class, 'get'])->where('id', '[0-9]+')->name('campaign');
    Route::get('/', [CampaignController::class, 'search'])->name('search-campaigns');
    Route::post('/', [CampaignController::class, 'store'])->name('store-campaign');
    Route::put('/{id}', [CampaignController::class, 'update'])->where('id', '[0-9]+')->name('update-campaign');
    Route::delete('/{id}', [CampaignController::class, 'destroy'])->where('id', '[0-9]+')->name('delete-campaign');
    Route::delete('/force/{id}', [CampaignController::class, 'forceDestroy'])->where('id', '[0-9]+')->name('force-delete-campaign');
    Route::post('/{id}', [CampaignController::class, 'restore'])->name('restore-campaign');
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
