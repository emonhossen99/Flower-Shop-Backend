<?php

use Illuminate\Support\Facades\Route;
use Modules\Feature\App\Http\Controllers\FeatureController;

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
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','is_verify']], function () {
    //-----------------feature route --------------------------------------//
    Route::resource('feature', FeatureController::class)->names('feature');
    Route::post('feature-get-data', [FeatureController::class,'getData'])->name('feature.get.data');
    Route::get('feature-delete/{id}', [FeatureController::class,'destroy'])->name('feature.delete');
    Route::put('category-update/{id}', [FeatureController::class,'Update'])->name('category.update');
    Route::get('category-status/{id}/{status}', [FeatureController::class,'featureStatus'])->name('feature.status');
});


