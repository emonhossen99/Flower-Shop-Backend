<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\App\Http\Controllers\LanguageController;

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
    Route::resource('language', LanguageController::class)->names('language');
    Route::get('language-list-data-get',[LanguageController::class,'getData'])->name('language.get.data');
    Route::get('language-list-status/{id}/{status}',[LanguageController::class,'statusChange'])->name('language.status');
    Route::post('language-list-update/{id}',[LanguageController::class,'Update'])->name('language.updates');
    Route::get('language-list-delete/{id}',[LanguageController::class,'destroy'])->name('language.destroy');
    Route::get('language-website-translate/{lang}',[LanguageController::class,'websiteTranslate'])->name('language.website.translate');
    Route::post('language-website-translate-store/{lang}',[LanguageController::class,'websiteTranslateStore'])->name('language.website.translate.store');
});

Route::post('/change-language', [LanguageController::class, 'changeLanguage'])->name('language.change');

