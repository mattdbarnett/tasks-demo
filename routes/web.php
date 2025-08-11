<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class,'index'])->name('home');
Route::post('/tasks/view-task', [TaskController::class,'viewTask'])->name('viewTask');
Route::post('/tasks/update-task', [TaskController::class,'updateTask'])->name('updateTask');
Route::post('/tasks/create-task', [TaskController::class,'createTask'])->name('createTask');
Route::post('/tasks/warning-task', [TaskController::class,'warningTask'])->name('warningTask');
Route::post('/tasks/delete-task', [TaskController::class,'deleteTask'])->name('deleteTask');