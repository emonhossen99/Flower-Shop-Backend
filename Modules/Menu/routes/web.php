<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\App\Http\Controllers\MenuController;

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
    //-----------------Menu Route --------------------------------------//
    Route::get('menu-status-change/{id}/{status}', [MenuController::class, 'changeStatus'])->name('menu.status.change');
    Route::resource('menu', MenuController::class)->names('menu');
    Route::post('menu-get-data', [MenuController::class, 'getData'])->name('menu.get.data');
    Route::post('menu-update/{id}', [MenuController::class, 'Update'])->name('menu.updates');
    Route::get('menu-delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
});

// radial-gradient( circle farthest-corner at 10% 20%,  0%,  90% )
