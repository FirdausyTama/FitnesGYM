<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MemberController as AdminMemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/face-scan', [AdminMemberController::class, 'faceScanPage'])->name('admin.face-scan');
    Route::post('/face-verify', [AdminMemberController::class, 'verifyFace'])->name('admin.face-verify');
    Route::get('/members', [AdminMemberController::class, 'index'])->name('admin.members.index');
    Route::post('/members', [AdminMemberController::class, 'store'])->name('admin.members.store');
    Route::get('/members/{member}', [AdminMemberController::class, 'show'])->name('admin.members.show');
    Route::put('/members/{member}', [AdminMemberController::class, 'update'])->name('admin.members.update');
    Route::post('/members/{member}/face', [AdminMemberController::class, 'updateFace'])->name('admin.members.updateFace');
    Route::delete('/members/{member}', [AdminMemberController::class, 'destroy'])->name('admin.members.destroy');
    Route::post('/attendance/{attendance}/checkout', [AdminMemberController::class, 'checkOut'])->name('admin.attendance.checkout');
    Route::post('/attendance/clear', [AdminMemberController::class, 'clearAttendance'])->name('admin.attendance.clear');
});

// Member Routes
Route::middleware(['auth'])->prefix('member')->group(function () {
    Route::get('/dashboard', function () {
        return view('member.dashboard');
    })->name('member.dashboard');
});
