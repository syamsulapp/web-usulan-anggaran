<?php

use App\Http\Controllers\MasterDataUsers;
use App\Http\Controllers\LembagaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaguController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UraianController;
use App\Http\Controllers\UsulanController;
use App\Http\Controllers\VerifikasiUsulanController;

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

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('profile/submit', [ProfileController::class, 'profileSubmit'])->name('profile.submit');
});

Auth::routes();

// Routes untuk fitur superadmin
Route::middleware('superadmin')->group(function () {
    Route::prefix('guest')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        Route::get('verifikasi-usulan', [VerifikasiUsulanController::class, 'index'])->name('superadmin.verifikasi_usulan');
        Route::get('show/{verifikasiUsulanModels}/usulan', [VerifikasiUsulanController::class, 'show'])->name('superadmin.show-usulan');
    });
});

// Routes untuk fitur admin
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        // USER MANAGEMENT
        Route::get('users', [MasterDataUsers::class, 'index'])->name('admin.users');
        Route::post('users/store', [MasterDataUsers::class, 'store'])->name('admin.users-stores');
        Route::put('users/update/{id}', [MasterDataUsers::class, 'update'])->name('admin.users-update');
        Route::delete('users/delete/{id}', [MasterDataUsers::class, 'delete'])->name('admin.users-delete');
        Route::post('users/verify/{id}', [MasterDataUsers::class, 'verifyAccountUsers'])->name('admin.users-verify');

        // PAGU MANAGEMENT


        Route::get('pagu', [PaguController::class, 'index'])->name('pagu.index');
        Route::post('pagu/tambah_pagu', [PaguController::class, 'tambah_pagu'])->name('tambah_pagu');
        Route::post('pagu/tambah-anggaran', [PaguController::class, 'tambah_anggaran'])->name('tambah_anggaran');
        Route::put('pagu/update/{id}', [PaguController::class, 'update'])->name('edit_pagu');
        Route::delete('pagu/delete/{id}', [PaguController::class, 'delete'])->name('delete_pagu');


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

// Routes untuk fitur pengguna
Route::middleware('user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
        //route buat usulan
        Route::get('buat-usulan', [UsulanController::class, 'index'])->name('users.buat_usulan');
        Route::post('submit-usulan', [UsulanController::class, 'store'])->name('users.submit_usulan');
        Route::delete('delete-usulan/{usulanModels}', [UsulanController::class, 'destroy'])->name('users.delete-usulan');
        Route::post('submit-anggaran/{anggaran}/{nama}/{photo}', [UsulanController::class, 'submitAnggaran'])->name('users.submit-anggaran');

        //route cetak usulan
    });
});
