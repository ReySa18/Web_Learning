<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\HasilLatihanController;



/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Autentikasi)
|--------------------------------------------------------------------------
*/

// Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Materi publik (GET tanpa login)
Route::get('/materi', [MateriController::class, 'index']);
Route::get('/materi/{id}', [MateriController::class, 'show']);

// Daftar semua user (jika memang dimaksudkan untuk publik, jika tidak, pindahkan ke grup auth)
Route::get('/users', [UserController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/topik', [TopikController::class, 'index']);
Route::get('/soal', [SoalController::class, 'index']);
Route::get('/soal', [SoalController::class, 'getByKategoriAndTopik']);
Route::get('/latihan/list', [SoalController::class, 'getLatihanList']);



/*
|--------------------------------------------------------------------------
| Protected Routes (Butuh Autentikasi via Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Ambil data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /*
    |--------------------------------------------------------------------------
    | Admin-only routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        // Tambah user oleh admin
        Route::post('/users', [UserController::class, 'store']);

        // Ubah role user
        Route::put('/users/{id}/role', [UserController::class, 'changeRole']);

        // Update user (misalnya nama/email)
        Route::put('/users/{id}', [UserController::class, 'update']);
    });

    /*
    |--------------------------------------------------------------------------
    | Materi - hanya user login yang bisa menambah
    |--------------------------------------------------------------------------
    */
    Route::post('/materi', [MateriController::class, 'store']);
    Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::post('/materi/{id}', [MateriController::class, 'update']); // untuk support _method PUT
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Soal - hanya user login yang bisa menambah
    |--------------------------------------------------------------------------
    */
    Route::post('/soal', [SoalController::class, 'store']);
    Route::put('/soal/{id}', [SoalController::class, 'update']);
    Route::delete('/soal/{id}', [SoalController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | User Management (Admin)
    |--------------------------------------------------------------------------
    */
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Menyimpan Hasil latihan
    |--------------------------------------------------------------------------
    */
    Route::post('/hasil-latihan', [HasilLatihanController::class, 'store']);
    Route::get('/hasil-latihan', [HasilLatihanController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Update Data User (User)
    |--------------------------------------------------------------------------
    */
    Route::put('/user', [UserController::class, 'updateProfile']);
    Route::put('/user/password', [UserController::class, 'updatePassword']);
});
