<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tentangBebras')->name('tentangBebras.')->group(function () {
    Route::view('/dd_1', 'pages.tentangBebras.dd_1')->name('dd_1');
    Route::view('/dd_2', 'pages.tentangBebras.dd_2')->name('dd_2');
    Route::view('/dd_3', 'pages.tentangBebras.dd_3')->name('dd_3');
    Route::view('/dd_4', 'pages.tentangBebras.dd_4')->name('dd_4');
    Route::view('/dd_5', 'pages.tentangBebras.dd_5')->name('dd_5');
    Route::view('/dd_6', 'pages.tentangBebras.dd_6')->name('dd_6');
});

Route::prefix('soal')->name('soal.')->group(function () {
    Route::view('/index-soal', 'pages.soal.index_soal')->name('index-soal');
    Route::view('/pembahasan-soal', 'pages.soal.pembahasan_soal')->name('pembahasan-soal');
    Route::view('/siaga-sd', 'pages.soal.sd')->name('siaga-sd');
    Route::view('/penggalang-smp', 'pages.soal.smp')->name('penggalang-smp');
    Route::view('/penegak-sma', 'pages.soal.sma')->name('penegak-sma');
});

Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
    Route::view('/workshop-2017', 'pages.kegiatan.workshop_2017')->name('workshop-2017');
});

Route::get('/latihan', function () {
    return view('pages.latihan.index');
})->name('latihan');

Route::get('/kontak', function () {
    return view('pages.kontak.index');
})->name('kontak');


