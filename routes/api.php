<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Admin\ArsipController;
use App\Http\Controllers\API\Admin\ProgramController;
use App\Http\Controllers\API\User\FormDonasiController;
use App\Http\Controllers\API\Admin\DataBarangController;
use App\Http\Controllers\API\Admin\DataDonasiController;
use App\Http\Controllers\API\Admin\DistribusiController;
use App\Http\Controllers\API\Admin\JenisArsipController;
use App\Http\Controllers\API\Admin\KontenProgramController;
use App\Http\Controllers\API\Admin\DistribusiBarangController;
use App\Http\Controllers\API\Admin\KontenPenyaluranController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen program
    Route::get('manajemen/program', [ProgramController::class, 'index']);
    Route::post('manajemen/program', [ProgramController::class, 'store']);
    Route::get('manajemen/program/edit/{id}', [ProgramController::class, 'edit']);
    Route::put('manajemen/program/update/{id}', [ProgramController::class, 'update']);
    Route::delete('manajemen/program/delete/{id}', [ProgramController::class, 'destroy']);
    
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen distribusi
    Route::get('manajemen/distribusi', [DistribusiController::class, 'index']);
    Route::post('manajemen/distribusi', [DistribusiController::class, 'store']);
    Route::get('manajemen/distribusi/edit/{id}', [DistribusiController::class, 'edit']);
    Route::put('manajemen/distribusi/update/{id}', [DistribusiController::class, 'update']);
    Route::delete('manajemen/distribusi/delete/{id}', [DistribusiController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen distribusi
    Route::get('manajemen/distribusi-barang', [DistribusiBarangController::class, 'index']);
    Route::post('manajemen/distribusi-barang', [DistribusiBarangController::class, 'store']);
    Route::get('manajemen/distribusi-barang/edit/{id}', [DistribusiBarangController::class, 'edit']);
    Route::put('manajemen/distribusi-barang/update/{id}', [DistribusiBarangController::class, 'update']);
    Route::delete('manajemen/distribusi-barang/delete/{id}', [DistribusiBarangController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen data donasi
    Route::get('manajemen/formdonasi', [FormDonasiController::class, 'index']);
    Route::post('manajemen/formdonasi', [FormdonasiController::class, 'store']);
    Route::get('manajemen/formdonasi/edit/{id}', [FormdonasiController::class, 'edit']);
    Route::put('manajemen/formdonasi/update/{id}', [FormBarangController::class, 'update']);
    Route::delete('manajemen/formdonasi/delete/{id}', [FormDonasiController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen Jenis Arsip
    Route::get('manajemen/jenisarsip', [JenisArsipController::class, 'index']);
    Route::post('manajemen/jenisarsip', [JenisArsipController::class, 'store']);
    Route::get('manajemen/jenisarsip/edit/{id}', [JenisArsipController::class, 'edit']);
    Route::put('manajemen/jenisarsip/update/{id}', [JenisArsipController::class, 'update']);
    Route::delete('manajemen/jenisarsip/delete/{id}', [JenisArsipController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen Konten Program
    Route::get('manajemen/kontenprogram', [KontenProgramController::class, 'index']);
    Route::post('manajemen/kontenprogram', [KontenProgramController::class, 'store']);
    Route::get('manajemen/kontenprogram/edit/{id}', [KontenProgramController::class, 'edit']);
    Route::put('manajemen/kontenprogram/update/{id}', [KontenProgramController::class, 'update']);
    Route::delete('manajemen/kontenprogram/delete/{id}', [KontenProgramController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen Konten Penyaluran
    Route::get('manajemen/kontenpenyaluran', [KontenPenyaluranController::class, 'index']);
    Route::post('manajemen/kontenpenyaluran', [KontenPenyaluranController::class, 'store']);
    Route::get('manajemen/kontenpenyaluran/edit/{id}', [KontenPenyaluranController::class, 'edit']);
    Route::put('manajemen/kontenpenyaluran/update/{id}', [KontenPenyaluranController::class, 'update']);
    Route::delete('manajemen/kontenpenyaluran/delete/{id}', [KontenPenyaluranController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen data barang
    Route::get('manajemen/databarang', [DataBarangController::class, 'index']);
    Route::post('manajemen/databarang', [DataBarangController::class, 'store']);
    Route::get('manajemen/databarang/edit/{id}', [DataBarangController::class, 'edit']);
    Route::put('manajemen/databarang/update/{id}', [DataBarangController::class, 'update']);
    Route::delete('manajemen/databarang/delete/{id}', [DataBarangController::class, 'destroy']);
});


Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen arsip
    Route::get('manajemen/arsip', [ArsipController::class, 'index']);
    Route::post('manajemen/arsip', [ArsipController::class, 'store']);
    Route::get('manajemen/arsip/edit/{id}', [ArsipController::class, 'edit']);
    Route::put('manajemen/arsip/update/{id}', [ArsipController::class, 'update']);
    Route::delete('manajemen/arsip/delete/{id}', [ArsipController::class, 'destroy']);
});

Route::prefix('admin/')->middleware('auth:sanctum')->group( function (){
    //manajemen data donasi
    Route::get('manajemen/datadonasi', [DataDonasiController::class, 'index']);
    Route::delete('manajemen/datadonasi/delete/{id}', [DataDonasiController::class, 'destroy']);
});


