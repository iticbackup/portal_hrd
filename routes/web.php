<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

// Route::get('/', function () {
//     return view('frontend.index');
// })->name('frontend');
// Route::get('formulir_antrian', function () {
//     return view('frontend.formulir_antrian');
// });
Route::get('/', [App\Http\Controllers\AntrianController::class, 'index'])->name('frontend');

Route::prefix('formulir_antrian')->group(function () {
    Route::get('/', [App\Http\Controllers\AntrianController::class, 'formulir_antrian'])->name('antrian');
    Route::get('search_nik/{nik}', [App\Http\Controllers\AntrianController::class, 'search_nik'])->name('antrian.search_nik');
    Route::post('simpan', [App\Http\Controllers\AntrianController::class, 'simpan'])->name('antrian.simpan');
});

Route::get('testing', function(){
    // return view('testing');
    event(new \App\Events\BackendAntrianNotification('1'));
});

Route::domain(parse_url(env('APP_URL'), PHP_URL_HOST))->group(function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        // Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::prefix('antrian')->group(function () {
            Route::get('/', [App\Http\Controllers\AntrianController::class, 'b_index'])->name('b_antrian');
            Route::post('detail_update', [App\Http\Controllers\AntrianController::class, 'b_detail_update'])->name('b_antrian.detail_update');
            Route::get('{id}', [App\Http\Controllers\AntrianController::class, 'b_detail'])->name('b_antrian.detail');
            Route::get('{id}/resend_mail', [App\Http\Controllers\AntrianController::class, 'b_resend_mail'])->name('b_antrian.resend_mail');
            Route::get('{id}/panggilan', [App\Http\Controllers\AntrianController::class, 'b_panggilan'])->name('b_antrian.panggilan');
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user');
            Route::post('simpan', [App\Http\Controllers\UserController::class, 'simpan'])->name('user.simpan');
            Route::get('{generate}', [App\Http\Controllers\UserController::class, 'detail'])->name('user.detail');
            Route::get('{generate}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::post('{generate}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        });
        Route::prefix('roles')->group(function () {
            Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
            Route::post('simpan', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
            Route::get('{id}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
            Route::post('{id}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
            Route::get('{id}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
        });
        Route::prefix('permission')->group(function () {
            Route::get('/', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission');
            Route::post('simpan', [App\Http\Controllers\PermissionController::class, 'simpan'])->name('permission.simpan');
            Route::get('{id}', [App\Http\Controllers\PermissionController::class, 'detail'])->name('permission.detail');
            Route::post('update', [App\Http\Controllers\PermissionController::class, 'update'])->name('permission.update');
        });
        // Route::prefix('periode')->group(function () {
        // });
    });
});
