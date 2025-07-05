<?php

use Illuminate\Support\Facades\Route;
use Modules\DatabaseReset\App\Http\Controllers\DatabaseResetController;

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
    Route::resource('databasereset', DatabaseResetController::class)->names('databasereset');
    Route::get('databasereset-delete/{id}',[DatabaseResetController::class,'destroy'])->name('databasereset.destroy');
});

