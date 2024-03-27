<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\HomeController;


Auth::routes();

Route::middleware('auth')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    Route::resource('users', UserController::class)->except(['destroy']);
    Route::get('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::resource('tasks', TaskController::class)->except(['destroy']);
    Route::get('/tasks/{id}/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');

});