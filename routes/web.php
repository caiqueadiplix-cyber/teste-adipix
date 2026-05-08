<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('people', PersonController::class);
Route::resource('tasks', TaskController::class);
