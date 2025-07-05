<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\ProductController;

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
    //-----------------Product route --------------------------------------//
    Route::resource('product', ProductController::class)->names('product');
    Route::put('product-update/{id}',[ ProductController::class,'Update'])->name('product.update');
    Route::get('product-delete/{id}',[ ProductController::class,'delete'])->name('product.delete');
    Route::post('product-get-data', [ProductController::class,'getData'])->name('product.get.data');
    Route::get('product-status/{id}/{status}', [ProductController::class,'productStatus'])->name('product.status');
    Route::delete('gallery-image/{id}', [ProductController::class,'galleryImageDelete'])->name('galley.image.delete');
});



