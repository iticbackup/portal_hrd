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

Route::prefix('formulir_ijin_keluar_masuk')->group(function () {
    Route::get('/', [App\Http\Controllers\IjinKeluarMasukController::class, 'f_index'])->name('f.form_ijin_keluar_masuk');
    Route::post('simpan', [App\Http\Controllers\IjinKeluarMasukController::class, 'f_simpan'])->name('f.form_ijin_keluar_masuk.simpan');
});

Route::prefix('formulir_ijin_absen')->group(function () {
    Route::get('/', [App\Http\Controllers\IjinAbsenController::class, 'f_index'])->name('f.form_ijin_absen');
    Route::post('simpan', [App\Http\Controllers\IjinAbsenController::class, 'f_simpan'])->name('f.form_ijin_absen.simpan');
});

// Route::get('testing', function(){
//     // return view('testing');
//     // event(new \App\Events\BackendAntrianNotification('1'));

// });

Route::get('testing', [App\Http\Controllers\TestingController::class, 'testing'])->name('testing');
Route::get('testing/ijin_absen', [App\Http\Controllers\TestingController::class, 'testing_mail_ijin_absen'])->name('testing_mail_ijin_absen');

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
        Route::prefix('ijin_keluar_masuk')->group(function () {
            Route::get('/', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_index'])->name('b_ijin_keluar_masuk');
            Route::post('input_jam_datang/update', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_input_jam_datang_update'])->name('b_ijin_keluar_masuk.b_input_jam_datang_update');
            Route::get('download_rekap', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_download_rekap'])->name('b_ijin_keluar_masuk.b_download_rekap');
            Route::get('{id}', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_detail'])->name('b_ijin_keluar_masuk.detail');
            Route::get('{id}/input_jam_datang', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_input_jam_datang'])->name('b_ijin_keluar_masuk.b_input_jam_datang');
            Route::get('{id}/validasi', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_validasi'])->name('b_ijin_keluar_masuk.b_validasi');
            Route::post('{id}/validasi/simpan', [App\Http\Controllers\IjinKeluarMasukController::class, 'b_validasi_simpan'])->name('b_ijin_keluar_masuk.b_validasi_simpan');
            Route::get('{id}/cetak_surat', [App\Http\Controllers\IjinKeluarMasukController::class, 'cetak_surat'])->name('b_ijin_keluar_masuk.cetak_surat');
        });
        Route::prefix('ijin_absen')->group(function () {
            Route::get('/', [App\Http\Controllers\IjinAbsenController::class, 'b_index'])->name('b_ijin_absen');
            Route::get('download_rekap', [App\Http\Controllers\IjinAbsenController::class, 'b_download_rekap'])->name('b_ijin_absen.b_download_rekap');
            Route::get('{id}', [App\Http\Controllers\IjinAbsenController::class, 'b_detail'])->name('b_ijin_absen.detail');
            Route::get('{id}/validasi', [App\Http\Controllers\IjinAbsenController::class, 'b_validasi'])->name('b_ijin_absen.validasi');
            Route::post('{id}/validasi/simpan', [App\Http\Controllers\IjinAbsenController::class, 'b_validasi_simpan'])->name('b_ijin_absen.b_validasi_simpan');
            Route::get('{id}/cetak_surat', [App\Http\Controllers\IjinAbsenController::class, 'cetak_surat'])->name('b_ijin_absen.cetak_surat');
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user');
            Route::post('simpan', [App\Http\Controllers\UserController::class, 'simpan'])->name('user.simpan');
            Route::post('import_user', [App\Http\Controllers\UserController::class, 'import_user'])->name('user.import_user');
            Route::get('search/{nama}', [App\Http\Controllers\UserController::class, 'search_nik'])->name('user.search_nik');
            Route::get('{generate}', [App\Http\Controllers\UserController::class, 'detail'])->name('user.detail');
            Route::get('{generate}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
            Route::post('{generate}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
            Route::get('{generate}/delete', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
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
