<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AboutItemController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/notes', NoteController::class)->middleware(['auth']);

Route::resource('/abouts', AboutController::class)->middleware(['auth']);

Route::resource('/aboutItens', AboutItemController::class)->middleware(['auth']);

require __DIR__.'/auth.php';