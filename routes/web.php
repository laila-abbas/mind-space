<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;


Route::get('/', function () {
    return view('home.index');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware(['auth', 'verified', 'role:Admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); 
    })->name('dashboard');  
});

Route::middleware(['auth', 'verified', 'role:Publisher'])
        ->prefix('publisher')
        ->name('publisher.')
        ->group(function () {
    Route::get('/dashboard', function () {
        return view('publisher.dashboard');
    })->name('dashboard');
});


Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');


Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware(['guest'])
    ->name('password.email');


Route::middleware(['auth'])->group(function () {
    Route::get('/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    
    Route::patch('/settings/info', [ProfileController::class, 'updateInfo'])->name('profile.updateInfo');
    
    Route::patch('/settings/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');   
});

Route::post('/locale', [LocaleController::class, 'set'])->name('locale.set');
