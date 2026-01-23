<?php

use Illuminate\Support\Facades\Route;

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
