<?php

use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
Route::resource('letter-templates', SuratController::class)->names('letter-templates');

