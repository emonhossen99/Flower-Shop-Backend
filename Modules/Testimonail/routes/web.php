<?php

use Illuminate\Support\Facades\Route;
use Modules\Testimonail\App\Http\Controllers\TestimonailController;

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
Route::group(['prefix'=>'admin','as'=>'admin.','middlware'=>['auth'=>'is_verify']], function () {
    //-----------------Testimonail route --------------------------------------//
    Route::resource('testimonail', TestimonailController::class)->names('testimonail');
    Route::put('testimonail-update/{id}',[ TestimonailController::class,'Update'])->name('testimonail.update');
    Route::get('testimonail-delete/{id}',[ TestimonailController::class,'delete'])->name('testimonail.delete');
    Route::post('testimonail-get-data', [TestimonailController::class,'getData'])->name('testimonail.get.data');
    Route::get('testimonail-status/{id}/{status}', [TestimonailController::class,'testimonailStatus'])->name('testimonail.status');
});