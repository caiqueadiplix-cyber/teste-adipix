<?php

use App\Http\Controllers\Api\PersonApiController;
use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::apiResource('people', PersonApiController::class);
    Route::apiResource('tasks', TaskApiController::class);

    Route::get('people/{person}/tasks', [PersonApiController::class, 'tasks'])->name('people.tasks.index');
    Route::put('people/{person}/tasks', [PersonApiController::class, 'syncTasks'])->name('people.tasks.sync');
    Route::delete('people/{person}/tasks/{task}', [PersonApiController::class, 'detachTask'])->name('people.tasks.detach');

    Route::get('tasks/{task}/people', [TaskApiController::class, 'people'])->name('tasks.people.index');
    Route::put('tasks/{task}/people', [TaskApiController::class, 'syncPeople'])->name('tasks.people.sync');
    Route::delete('tasks/{task}/people/{person}', [TaskApiController::class, 'detachPerson'])->name('tasks.people.detach');
});
