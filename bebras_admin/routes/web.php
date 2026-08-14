<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\TentangBebrasController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('app');
// });

Route::get('/', [AuthController::class, 'showLogin']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// khusus admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
    Route::prefix('akun')->group(function () {
        Route::get('/register', [RegisterController::class, 'index'])->name('register');
        Route::get('/get-akun', [RegisterController::class, 'getAkun'])->name('register.get-akun');
        Route::post('/store', [RegisterController::class, 'store'])->name('store.akun');
        Route::get('/{user}/edit', [RegisterController::class, 'edit'])->name('edit.akun');
        Route::put('/{user}', [RegisterController::class, 'update'])->name('update.akun');
        Route::delete('/{user}', [RegisterController::class, 'destroy'])->name('destroy.akun');
    });

    Route::prefix('tentang-bebras')->group(function () {
        Route::get('/', [TentangBebrasController::class, 'index'])->name('tentang_bebras.index');
        Route::get('/form', [TentangBebrasController::class, 'create'])->name('form-tentang-bebras');
        Route::post('/store', [TentangBebrasController::class, 'store'])->name('tentang_bebras.store');
        Route::get('/get-data', [TentangBebrasController::class, 'getData'])->name('tentang_bebras.data');
        Route::get('/{id}', [TentangBebrasController::class, 'show'])->name('tentang_bebras.show');
        Route::get('/{id}/edit', [TentangBebrasController::class, 'edit'])->name('tentang_bebras.edit');
        Route::put('/{id}', [TentangBebrasController::class, 'update'])->name('tentang_bebras.update');
        Route::delete('/{id}', [TentangBebrasController::class, 'destroy'])->name('tentang_bebras.destroy');

        // Child items routes
        Route::post('/{tentang_bebras_id}/items', [TentangBebrasController::class, 'storeItemChild'])->name('tentang_bebras.items.store');
        Route::put('/items/{id}', [TentangBebrasController::class, 'updateItemChild'])->name('tentang_bebras.items.update');
        Route::delete('/items/{id}', [TentangBebrasController::class, 'destroyItemChild'])->name('tentang_bebras.items.destroy');
    });

    Route::prefix('soal-bebras')->group(function () {
        Route::get('/', [SoalController::class, 'index'])->name('soal_bebras.index');
        Route::get('/form', [SoalController::class, 'create'])->name('form-soal-bebras');
        Route::post('/store', [SoalController::class, 'store'])->name('soal_bebras.store');
        Route::get('/{id}', [SoalController::class, 'show'])->name('soal_bebras.show');
        Route::get('/{id}/edit', [SoalController::class, 'edit'])->name('soal_bebras.edit');
        Route::put('/{id}', [SoalController::class, 'update'])->name('soal_bebras.update');
        Route::delete('/{id}', [SoalController::class, 'destroy'])->name('soal_bebras.destroy');
    });

    Route::prefix('kontak')->group(function () {
        Route::get('/', [KontakController::class, 'index'])->name('kontak.index');
        Route::post('/store', [KontakController::class, 'store'])->name('kontak.store');
        Route::get('/list', [KontakController::class, 'list'])->name('kontak.list');
        Route::get('/detail/{id}', [KontakController::class, 'detail'])->name('kontak.detail');
        Route::get('/{id}/edit', [KontakController::class, 'edit'])->name('kontak.edit');
        Route::put('/{id}', [KontakController::class, 'update'])->name('kontak.update');
        Route::delete('/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');
    });

    Route::prefix('latihan')->group(function () {
        Route::get('/', [LatihanController::class, 'index'])->name('latihan.index');
        Route::post('/store', [LatihanController::class, 'store'])->name('latihan.store');
        Route::get('/list', [LatihanController::class, 'list'])->name('latihan.list');
        Route::get('/{id}/edit', [LatihanController::class, 'edit'])->name('latihan.edit');
        Route::post('/{id}/update', [LatihanController::class, 'update'])->name('latihan.update');
        Route::delete('/{id}', [LatihanController::class, 'destroy'])->name('latihan.destroy');
        Route::get('/{id}/deskripsi', [LatihanController::class, 'deskripsi'])->name('latihan.deskripsi');
    });

    // Banner (Carousel)
    Route::prefix('banner')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('banner.index');
        Route::get('/list', [BannerController::class, 'list'])->name('banner.list');
        Route::get('/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('/store', [BannerController::class, 'store'])->name('banner.store');
        Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('banner.edit');
        Route::put('/{id}', [BannerController::class, 'update'])->name('banner.update');
        Route::delete('/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');
    });

    // Kegiatan (Utama + Workshop 2017)
    Route::prefix('kegiatan')->group(function () {
        Route::get('/', [KegiatanController::class, 'index'])->name('kegiatan.index');
        Route::get('/list', [KegiatanController::class, 'list'])->name('kegiatan.list');
        Route::get('/create', [KegiatanController::class, 'create'])->name('kegiatan.create');
        Route::post('/store', [KegiatanController::class, 'store'])->name('kegiatan.store');
        Route::get('/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatan.edit');
        Route::put('/{id}', [KegiatanController::class, 'update'])->name('kegiatan.update');
        Route::delete('/{id}', [KegiatanController::class, 'destroy'])->name('kegiatan.destroy');
    });

    // Pengaturan Situs
    Route::prefix('pengaturan')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/list', [SettingController::class, 'list'])->name('setting.list');
        Route::get('/create', [SettingController::class, 'create'])->name('setting.create');
        Route::post('/store', [SettingController::class, 'store'])->name('setting.store');
        Route::get('/{id}/edit', [SettingController::class, 'edit'])->name('setting.edit');
        Route::put('/{id}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/{id}', [SettingController::class, 'destroy'])->name('setting.destroy');
    });

});
