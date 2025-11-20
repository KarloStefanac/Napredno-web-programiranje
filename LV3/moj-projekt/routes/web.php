<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profil', [ProfileController::class, 'show'])->name('profil.show');
    
    // Spremanje novog projekta
    Route::post('/projekti', [ProjectController::class, 'store'])->name('projekti.store');
    Route::get('/projekti/create', [ProjectController::class, 'create'])->name('projekti.create');
     Route::get('/projekti/{project}/edit', [ProjectController::class, 'edit'])->name('projekti.edit');
    Route::put('/projekti/{project}', [ProjectController::class, 'update'])->name('projekti.update');
    Route::delete('/projekti/{project}', [ProjectController::class, 'destroy'])->name('projekti.destroy');
});

require __DIR__.'/auth.php';
