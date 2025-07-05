<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\MainIndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ReviewController;
use Modules\Subscriber\App\Http\Controllers\SubscriberController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//------------ Disable Route ------------//
Auth::routes([
    'register'         => false,
    'verify'           => false,
    'password.reset'   => false,
    'password.update'  => false,
    'password.email'   => false,
    'password.request' => false
]);
//------------ Home Route ------------//
Route::get('/', [MainIndexController::class, 'index'])->name('index');

//------------ Dynamic Style CSS ------------//
Route::get('/dynamic-style.css', [MainIndexController::class, 'generateCSS'])->name('dynamic.style');


//------------ Register Route ------------//
Route::get('register', [AuthController::class, 'index'])->name('user.register');
Route::post('register/store', [AuthController::class, 'store'])->name('user.register.store');

//------------ Varify User ------------//
Route::get('verify-code/{token}', [AuthController::class, 'verifiedCode'])->name('verify.code');

//------------ Forgot password  ------------//
Route::get('forgot-passowrd', [AuthController::class, 'forgotPassword'])->name('forgot.password');
Route::post('forgot-passowrd/sent', [AuthController::class, 'forgotPasswordSent'])->name('forgot.password.sent');
Route::get('forgot-passowrd-token/{token}', [AuthController::class, 'forgotPasswordToken'])->name('forgot.password.token');
Route::post('password-update', [AuthController::class, 'passwordUpdate'])->name('user.password.update');


Route::get('add-to-cart/{id}', [MainIndexController::class, 'addToCart'])->name('add.to.cart');
Route::get('/product/{id}', [MainIndexController::class, 'productshow'])->name('view.product');
