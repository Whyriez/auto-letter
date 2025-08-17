<?php

use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
Route::post('letter-templates/{template}/duplicate', [SuratController::class, 'duplicate'])->name('letter-templates.duplicate');
Route::resource('letter-templates', SuratController::class)->names('letter-templates');

Route::resource('letter-types', JenisSuratController::class)->names('letter-types');

Route::resource('mahasiswa', MahasiswaController::class)->names('mahasiswa');

Route::resource('kajur', KajurController::class)->names('kajur');
Route::get('/kajur/approveAndExportPdf/{id}', [KajurController::class, 'approveAndExportPdf'])->name('kajur.approveAndExportPdf');

Route::get('/verify/{unique_code}', [VerificationController::class, 'verify'])->name('verify.check');