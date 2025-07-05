<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\App\Http\Controllers\OrderController;

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
    Route::resource('order', OrderController::class)->names('order');
    Route::get('order-edit/{id}', [OrderController::class, 'orderEdit'])->name('order.edit');
    Route::post('order-get-data', [OrderController::class, 'getData'])->name('order.get.data');
    Route::get('order-delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    Route::post('price-update', [OrderController::class, 'priceupdate'])->name('price.update');
    Route::post('/single-order-update', [OrderController::class, 'orderUpdate'])->name('single.order.update');
    Route::post('charge-update', [OrderController::class, 'chargeupdate'])->name('charge.update');
    Route::get('order-invoice/{id}', [OrderController::class, 'invoiceShow'])->name('order.invoice');
    Route::post('discount-update', [OrderController::class, 'discountupdate'])->name('discount.update');
    Route::get('order-status/{id}/{status}', [OrderController::class, 'orderStatus'])->name('order.status');
    Route::post('send-stead-fast', [OrderController::class, 'sendToSteadFast'])->name('send.stead.fast');
    Route::post('send-pathao', [OrderController::class, 'sendToPathao'])->name('send.pathao');
    Route::post('order-bluk-delete', [OrderController::class, 'orderBlukDelete'])->name('order.bluk.delete');
    Route::post('order-bluk-status-change', [OrderController::class, 'orderBlukStatusChange'])->name('order.bluk.status.change');
    Route::post('order-bluk-prints', [OrderController::class, 'orderBlukPrints'])->name('order.bluk.prints');
    Route::get('order-zone-list/{id}', [OrderController::class, 'orderZoneList'])->name('order.zone.list');
    Route::delete('single-product-delete/{id}', [OrderController::class, 'singleProductDelete'])->name('single.product.delete');
});
