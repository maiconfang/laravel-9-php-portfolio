<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/notes', NoteController::class)->middleware(['auth']);

Route::resource('/abouts', AboutController::class)->middleware(['auth']);

require __DIR__.'/auth.php';