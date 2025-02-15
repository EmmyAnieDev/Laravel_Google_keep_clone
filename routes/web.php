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

    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');
    Route::post('/notes/appearance', [NoteController::class, 'changeAppearance'])->name('notes.appearance');
    Route::get('/notes/archived', [NoteController::class, 'archived'])->name('notes.archived');
    Route::get('/notes/archive/{id}', [NoteController::class, 'toogleArchive'])->name('notes.archive');
    Route::get('/notes/bin', [NoteController::class, 'bin'])->name('notes.bin');
    Route::get('/notes/restore/{id}', [NoteController::class, 'restore'])->name('notes.restore');
    Route::get('/notes/permanent-delete/{id}', [NoteController::class, 'forceDestroy'])->name('notes.permanent-delete');
    Route::resource('/notes', NoteController::class);

});

require __DIR__.'/auth.php';
