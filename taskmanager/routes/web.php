<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect root to the task list
Route::redirect('/', '/tasks');

Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.status');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
