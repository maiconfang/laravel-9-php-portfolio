<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AboutItemController;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', [WelcomeController::class, 'index']);

Route::resource('/notes', NoteController::class)->middleware(['auth']);

Route::resource('/abouts', AboutController::class)->middleware(['auth']);

Route::resource('/aboutItens', AboutItemController::class)->middleware(['auth']);

Route::resource('/projects', ProjectController::class)->middleware(['auth']);

Route::get('/publicAboutUrl', [AboutController::class, 'publicMethod']);

Route::get('/publicProjectUrl', [ProjectController::class, 'publicMethod']);


require __DIR__.'/auth.php';