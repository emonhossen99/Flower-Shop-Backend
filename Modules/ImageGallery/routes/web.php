<?php

use Illuminate\Support\Facades\Route;
use Modules\ImageGallery\App\Http\Controllers\ImageGalleryController;

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
    Route::resource('imagegallery', ImageGalleryController::class)->names('imagegallery');
    // web.php or api.php
    Route::delete('/delete-image/{id}', [ImageGalleryController::class, 'destroy'])->name('image.destroy');
    

});
