<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuratEditorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//? Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa', function () {
        return view('mahasiswa.index');
    })->name('mahasiswa.dashboard');
});

//? Kaprodi
Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('/kaprodi', function () {
        return view('ketua_staff.kaprodi.index');
    })->name('kaprodi.dashboard');
});

//? Kajur
Route::middleware(['auth', 'role:kajur'])->group(function () {
    Route::get('/kajur', function () {
        return view('ketua_staff.kajur.index');
    })->name('kajur.dashboard');
});

//? Admin Jurusan
Route::middleware(['auth', 'role:admin_jurusan'])->group(function () {
    Route::get('/admin_jurusan', function () {
        return view('admin.jurusan.index');
    })->name('admin_jurusan.dashboard');
});

//? Super Admin
Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
    Route::post('/dashboard/submit-new-user', [SuperAdminController::class, 'submit_new_user'])->name('super_admin.submit_new_user');
    Route::get('/dashboard/users/{id}', [SuperAdminController::class, 'show_user'])->name('super_admin.show_user');
    Route::put('/dashboard/users/{id}', [SuperAdminController::class, 'update_user'])->name('super_admin.update_user');
    Route::delete('/dashboard/users/{id}', [SuperAdminController::class, 'delete_user'])->name('super_admin.delete_user');
    Route::patch('/dashboard/users/{id}/toggle-suspend', [SuperAdminController::class, 'toggleSuspend'])->name('super_admin.toggle_suspend');
    Route::patch('/dashboard/users/{id}/update-role', [SuperAdminController::class, 'updateRole'])->name('super_admin.update_role');
});

// Auth Controller
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login_process'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
