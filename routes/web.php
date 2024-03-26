<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'handleGoogleCallback']);

Route::group([
    'prefix' => 'panel/'
], function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::group([
        'middleware' => 'auth',
        'prefix' => 'artikel',
        'as' => 'articles.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\ArticleController::class, 'index'])->middleware('permission:lihat-artikel')->name('index');
        Route::get('/tulis', [\App\Http\Controllers\ArticleController::class, 'create'])->middleware('permission:tambah-artikel')->name('create');
        Route::post('/', [\App\Http\Controllers\ArticleController::class, 'store'])->middleware('permission:tambah-artikel')->name('store');
        Route::get('/{article}/edit', [\App\Http\Controllers\ArticleController::class, 'edit'])->middleware('permission:edit-artikel')->name('edit');
        Route::put('/{article}', [\App\Http\Controllers\ArticleController::class, 'update'])->middleware('permission:edit-artikel')->name('update');
        Route::delete('/{article}', [\App\Http\Controllers\ArticleController::class, 'destroy'])->middleware('permission:hapus-artikel')->name('destroy');
    });

    Route::group([
        'middleware' => 'auth',
        'prefix' => 'program',
        'as' => 'programs.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\ProgramController::class, 'index'])->middleware('permission:lihat-program')->name('index');
        Route::get('/buat', [\App\Http\Controllers\ProgramController::class, 'create'])->middleware('permission:tambah-program')->name('create');
        Route::post('/', [\App\Http\Controllers\ProgramController::class, 'store'])->middleware('permission:tambah-program')->name('store');
        Route::get('/{program}/edit', [\App\Http\Controllers\ProgramController::class, 'edit'])->middleware('permission:edit-program')->name('edit');
        Route::put('/{program}', [\App\Http\Controllers\ProgramController::class, 'update'])->middleware('permission:edit-program')->name('update');
        Route::delete('/{program}', [\App\Http\Controllers\ProgramController::class, 'destroy'])->middleware('permission:hapus-program')->name('destroy');

        Route::get('detail/{program}', [\App\Http\Controllers\ProgramController::class, 'show'])->middleware('permission:lihat-program')->name('show');


    });
    Route::group([
        'middleware' => 'auth',
        'prefix' => 'program/{programId}/kegiatan',
        'as' => 'program_activities.',
    ], function () {
        Route::get('/', [\App\Http\Controllers\ProgramActivityController::class, 'index'])->middleware('permission:lihat-kegiatan-program')->name('index')->whereNumber('programId');
        Route::get('/buat', [\App\Http\Controllers\ProgramActivityController::class, 'create'])->middleware('permission:tambah-kegiatan-program')->name('create');
        Route::post('/', [\App\Http\Controllers\ProgramActivityController::class, 'store'])->middleware('permission:tambah-kegiatan-program')->name('store');
        Route::get('/{programActivity}/edit', [\App\Http\Controllers\ProgramActivityController::class, 'edit'])->middleware('permission:edit-kegiatan-program')->name('edit');
        Route::put('/{programActivity}', [\App\Http\Controllers\ProgramActivityController::class, 'update'])->middleware('permission:edit-kegiatan-program')->name('update');
        Route::delete('/{programActivity}', [\App\Http\Controllers\ProgramActivityController::class, 'destroy'])->middleware('permission:hapus-kegiatan-program')->name('destroy');

        Route::get('/detail/{programActivity}', [\App\Http\Controllers\ProgramActivityController::class, 'show'])->middleware('permission:lihat-kegiatan-program')->name('show');
    });
});

Route::group([
    'as' => 'main.',
], function () {
    Route::get('', [\App\Http\Controllers\Main\HomeController::class, 'home'])->name('home');
    Route::group([
        'as' => 'articles.',
        'prefix' => 'artikel',
    ], function () {
        Route::get('', [\App\Http\Controllers\Main\ArticleController::class, 'list'])->name('list');
        Route::get('/{article}', [\App\Http\Controllers\Main\ArticleController::class, 'detail'])->name('detail');
    });

    Route::group([
        'as' => 'programs.',
        'prefix' => 'program',
    ], function () {
        Route::get('', [\App\Http\Controllers\Main\ProgramController::class, 'list'])->name('list');
        Route::get('/{program}', [\App\Http\Controllers\Main\ProgramController::class, 'detail'])->name('detail');
    });
    Route::group([
        'as' => 'donations.',
        'prefix' => 'donasi'
    ], function () {
        Route::post('beri-donasi', [\App\Http\Controllers\Main\DonationController::class, 'makeDonation'])->name('make_donation');
        Route::get('saya/{donation}', [\App\Http\Controllers\Main\DonationController::class, 'detail'])->name('detail');
    });
});

Route::get('tes', function () {
    // return new \App\Events\TesEvent();
    // return view('main.donation.detail');
    return time();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
