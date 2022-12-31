<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\ComposerController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Login Routes
Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [AdminLoginController::class, 'login']);
Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

Route::middleware('auth:admin')->group(function () {
    Route::get('403', function() {
        return view('admin.layout.403');
    })->name('403');

    Route::middleware('permission')->group(function() {
        Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard');

        Route::resource('admins', AdminController::class);
        Route::resource('users', UserController::class);
        Route::resource('roles', RolesController::class);

        // action log viewer
        Route::get('user_action_logs', [AdminController::class, 'viewActionLogs'])->name('log.index');

    });
});
