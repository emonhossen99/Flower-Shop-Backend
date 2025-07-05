<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\App\Http\Controllers\SettingController;

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
    //-----------------Setting Route --------------------------------------//
    Route::resource('setting', SettingController::class)->names('setting')->except(['show']);
    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::resource('setting', SettingController::class)->names('setting');
        Route::post('/hero-store',[SettingController::class,'heroStore'])->name('hero.store');
        Route::post('/special-moments',[SettingController::class,'specialMomentsStore'])->name('special.moments.store');
        Route::post('/latest-additions',[SettingController::class,'latestAdditionsStore'])->name('latest.additions.store');
        Route::post('/special-offer',[SettingController::class,'specialOfferStore'])->name('special.offer.store');
        Route::post('/best-selling-store',[SettingController::class,'bestSellingStore'])->name('best.selling.store');
        Route::post('/testimonail-store',[SettingController::class,'testimonailStore'])->name('testimonail.store');
        Route::post('/call-to-action',[SettingController::class,'callToActionStore'])->name('call.to.action.store');
        Route::post('/footer-section-store',[SettingController::class,'footerSectionStore'])->name('footer.section.store');
    });
});
