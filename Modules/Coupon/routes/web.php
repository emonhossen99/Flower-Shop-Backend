<?php

use Illuminate\Support\Facades\Route;
use Modules\Coupon\App\Http\Controllers\CouponController;

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
    Route::resource('coupon', CouponController::class)->names('coupon');
    Route::put('coupon-update/{id}',[ CouponController::class,'Update'])->name('coupon.update');
    Route::get('coupon-delete/{id}',[ CouponController::class,'destroy'])->name('coupon.delete');
    Route::get('coupon-get-data', [CouponController::class,'getData'])->name('coupon.get.data');
    Route::get('coupon-status/{id}/{status}', [CouponController::class,'changeStatus'])->name('coupon.status.change');
});

Route::post('match-coupon',[CouponController::class,'matchCoupon'])->name('match-coupon');
Route::post('order-store-frontend-two',[CouponController::class,'orderStoreFrontendTwo'])->name('order.store.frontend.two');
Route::get('order-success/{order_id}',[CouponController::class,'orderSuccessTwo'])->name('order.success.two');
Route::get('order-invoice-download/{order_id}',[CouponController::class,'orderInvoiceDownload'])->name('order.invoice.download');