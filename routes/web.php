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
Route::post('/tasks/viewTask', [TaskController::class,'viewTask'])->name('viewTask');
Route::post('/tasks/updateTask', [TaskController::class,'updateTask'])->name('updateTask');
Route::post('/tasks/createTask', [TaskController::class,'createTask'])->name('createTask');
Route::post('/tasks/warningTask', [TaskController::class,'warningTask'])->name('warningTask');
Route::post('/tasks/deleteTask', [TaskController::class,'deleteTask'])->name('deleteTask');