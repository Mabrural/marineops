<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCompanyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PortController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// super admin
Route::middleware(['auth', 'verified', 'platform.admin'])->group(function () {
    Route::resource('companies', CompanyController::class);

    Route::resource('user-management', UserController::class);

    // Custom actions
    Route::post('/user-management/{user:slug}/grant-admin', [UserController::class, 'grantAdmin'])
        ->name('user-management.grant-admin');

    Route::post('/user-management/{user:slug}/revoke-admin', [UserController::class, 'revokeAdmin'])
        ->name('user-management.revoke-admin');

    Route::post('/user-management/{user:slug}/activate', [UserController::class, 'activate'])
        ->name('user-management.activate');

    Route::post('/user-management/{user:slug}/deactivate', [UserController::class, 'deactivate'])
        ->name('user-management.deactivate');

    Route::get('/user-company-assign', [UserCompanyController::class, 'index'])->name('user-company-assign.index');

    Route::get('/user-company-assign/create/{id}', [UserCompanyController::class, 'create'])->name('user-company-assign.create');
    Route::post('user-company-assign/{id}', [UserCompanyController::class, 'store'])
        ->name('user-company-assign.store');

    Route::delete('/user-company-assign/{user}', [UserCompanyController::class, 'destroy'])
        ->name('user-company-assign.destroy');

});

// internal operasion
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('ports', PortController::class);
    Route::resource('vessels', PortController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
