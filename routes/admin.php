<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Admin\DashboardController;

// Group Route
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth','is_verify']], function () {
    //------------------------ Dashboard -----------------------//
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('index');
        Route::get('/create', [DashboardController::class, 'create'])->name('create');
        Route::get('/pay-bill-customer-supplier/{id}/{role}', [DashboardController::class, 'payBillCustomerSupplier'])->name('pay.bill.customer.supplier');
        Route::post('/pay-bill-customer-supplier-store', [DashboardController::class, 'payBillCustomerSupplierStore'])->name('pay.bill.customer.supplier.store');
        Route::post('/customer-supplier', [DashboardController::class, 'customerSupplier'])->name('customer.supplier.store');
        Route::get('/pay-bill/{role}', [DashboardController::class, 'payBill'])->name('pay.bill');
        Route::post('/pay-bill-store', [DashboardController::class, 'payBillStore'])->name('pay.bill.store');
        Route::get('/casebox-amount-check', [DashboardController::class, 'cashboxAmountCheck'])->name('casebox.amount.check');
        Route::post('/order-chart-count', [DashboardController::class, 'dashboardOrderChartCount'])->name('order.chart.count');
        Route::post('/products-chart-count', [DashboardController::class, 'dashboardProductsChartCount'])->name('products.chart.count');
        Route::get('/order-riview', [DashboardController::class, 'orderReview'])->name('order.review');
    });
});



