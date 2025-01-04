<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/notes', NoteController::class);
    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');
    Route::post('/notes/appearance', [NoteController::class, 'changeAppearance'])->name('notes.appearance');

});

require __DIR__.'/auth.php';
