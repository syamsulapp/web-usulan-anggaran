<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LembagaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PaguController;
use App\Http\Controllers\UraianController;

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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::prefix('home')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('profile/submit', [App\Http\Controllers\HomeController::class, 'profileSubmit'])->name('profile.submit');
});

Auth::routes();

// Rute untuk superadmin
Route::middleware('superadmin')->group(function () {
    Route::prefix('guest')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        Route::get('verifikasi-usulan', function () {
            return 'halo';
        })->name('superadmin.verifikasi_usulan');
    });
});

// Rute untuk admin
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        // USER MANAGEMENT
        Route::get('users', [AdminController::class, 'index'])->name('admin.users');
        Route::post('users/store', [AdminController::class, 'store'])->name('admin.users-stores');
        Route::get('users/edit/{id}', [AdminController::class, 'edit'])->name('admin.users-edit');
        Route::put('users/update/{id}', [AdminController::class, 'update'])->name('admin.users-update');
        Route::delete('users/delete/{id}', [AdminController::class, 'delete'])->name('admin.users-delete');
        Route::post('users/activate/{id}', [AdminController::class, 'activate'])->name('admin.users-activate');
        Route::post('users/inactive/{id}', [AdminController::class, 'inactive'])->name('admin.users-inactive');

        // PAGU MANAGEMENT


        Route::get('pagu', [PaguController::class, 'index'])->name('pagu.index');
        Route::post('pagu/tambah_pagu', [PaguController::class, 'tambah_pagu'])->name('tambah_pagu');
        Route::post('pagu/tambah-anggaran', [PaguController::class, 'tambah_anggaran'])->name('tambah_anggaran');


        //Lembaga MANAGEMENT
        Route::get('lembaga', [LembagaController::class, 'index'])->name('lembaga.index');
        Route::post('lembaga/store', [LembagaController::class, 'store'])->name('lembaga.store');
        Route::put('lembaga/{id}', [LembagaController::class, 'update'])->name('lembaga.update');
        Route::delete('lembaga/{id}', [LembagaController::class, 'destroy'])->name('lembaga.destroy');

        //Lembaga MANAGEMENT
        Route::get('uraian', [UraianController::class, 'index'])->name('uraian.index');
        Route::post('uraian/store', [UraianController::class, 'store'])->name('uraian.store');
        Route::put('uraian/{id}', [UraianController::class, 'update'])->name('uraian.update');
        Route::delete('uraian/{id}', [UraianController::class, 'destroy'])->name('uraian.destroy');
    });
});

// Rute untuk pengguna
Route::middleware('user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        Route::get('buat-usulan', function () {
            return 'halo buat usulan';
        })->name('users.buat_usulan');
        Route::get('revisi-usulan', function () {
            return 'halo buat usulan';
        })->name('users.revisi_usulan');
    });
});
