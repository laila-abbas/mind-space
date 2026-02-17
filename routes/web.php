<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\AuthorController;


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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::delete('/account', [ProfileController::class, 'destroy'])
        ->name('account.destroy');
});

Route::get('/account/restore/{user}', [ProfileController::class, 'restore'])
    ->name('account.restore')
    ->middleware('signed'); // add a secret key (only the button in the email would work)

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');