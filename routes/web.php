<?php

use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\KajurController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\SuratEditorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {

    //? Mahasiswa
    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::resource('mahasiswa', MahasiswaController::class)->names('mahasiswa');
    });

    //? Kaprodi
    Route::middleware(['role:kaprodi'])->group(function () {
        Route::resource('kaprodi', KaprodiController::class)->names('kaprodi');
        Route::get('/kaprodi/approveAndExportPdf/{id}', [KaprodiController::class, 'approveAndExportPdf'])->name('kaprodi.approveAndExportPdf');
        Route::get('/preview-surat/{id}/kaprodi', [KaprodiController::class, 'previewSurat'])->name('kaprodi.preview');
    });

    //? Kajur
    Route::middleware(['role:kajur'])->group(function () {
        Route::resource('kajur', KajurController::class)->names('kajur');
        Route::get('/kajur/approveAndExportPdf/{id}', [KajurController::class, 'approveAndExportPdf'])->name('kajur.approveAndExportPdf');
        Route::get('/preview-surat/{id}', [KajurController::class, 'previewSurat'])->name('kajur.preview');
    });

    //? Admin Jurusan
    Route::middleware(['role:admin_jurusan'])->group(function () {
        Route::get('/admin-jurusan', [AdminJurusanController::class, 'index'])->name('admin_jurusan.dashboard');
        Route::resource('template-surat', SuratController::class)->names('template-surat');
        Route::post('template-surat/{template}/duplicate', [SuratController::class, 'duplicate'])->name('template-surat.duplicate');
        Route::resource('jenis-surat', JenisSuratController::class)->names('jenis-surat');
    });

    //? Super Admin
    Route::middleware(['role:super_admin'])->group(function () {
        Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::get('/dashboard/users', [SuperAdminController::class, 'user'])->name('super_admin.users');
        Route::post('/dashboard/submit-new-user', [SuperAdminController::class, 'submit_new_user'])->name('super_admin.submit_new_user');
        Route::get('/dashboard/users/{id}', [SuperAdminController::class, 'show_user'])->name('super_admin.show_user');
        Route::put('/dashboard/users/{id}', [SuperAdminController::class, 'update_user'])->name('super_admin.update_user');
        Route::delete('/dashboard/users/{id}', [SuperAdminController::class, 'delete_user'])->name('super_admin.delete_user');
        Route::patch('/dashboard/users/{id}/toggle-suspend', [SuperAdminController::class, 'toggleSuspend'])->name('super_admin.toggle_suspend');
        Route::patch('/dashboard/users/{id}/update-role', [SuperAdminController::class, 'updateRole'])->name('super_admin.update_role');
    });

    // ? update profile
    Route::get('/dashboard/settings', [UserController::class, 'edit_profile'])->name('dashboard.setting');
    Route::put('/dashboard/settings/update', [UserController::class, 'update_profile'])->name('dashboard.setting.update');
    Route::delete('/dashboard/settings/delete-qr', [UserController::class, 'destroyQr'])->name('profile.ttd_qr.destroy');
});



// Auth Controller
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login_process'])->name('login.process');
});

Route::get('/verify/{unique_code}', [VerificationController::class, 'verify'])->name('verify.check');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
