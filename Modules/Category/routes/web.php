<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

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

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'is_verify']], function () {
    //-----------------Category route --------------------------------------//
    Route::resource('category', CategoryController::class)->names('category');
    Route::post('category-get-data', [CategoryController::class, 'getData'])->name('category.get.data');
    Route::get('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::post('category-update/{id}', [CategoryController::class, 'Update'])->name('category.updates');
    Route::post('category-sub-menu', [CategoryController::class, 'categorySubMenu'])->name('category.sub.menu');
    Route::get('category-status-change/{id}/{status}', [CategoryController::class, 'changeStatus'])->name('category.status.change');
});

Route::group(['prefix' => 'staff', 'as' => 'staff.', 'middleware' => ['auth','is_verify']], function () {
    //-----------------Category route --------------------------------------//
    Route::resource('category', CategoryController::class)->names('category');
    Route::post('category-get-data', [CategoryController::class, 'getData'])->name('category.get.data');
    Route::get('category-delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::post('category-update/{id}', [CategoryController::class, 'Update'])->name('category.updates');
    Route::get('category-status-change/{id}/{status}', [CategoryController::class, 'changeStatus'])->name('category.status.change');
});
