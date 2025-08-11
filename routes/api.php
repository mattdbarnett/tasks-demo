<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/tasks/create-task', [TaskApiController::class,'createTask'])->name('createTask');
Route::post('/tasks/get-task', [TaskApiController::class,'getTask'])->name('getTask');
Route::post('/tasks/get-tasks', [TaskApiController::class,'getTasks'])->name('getTasks');
Route::post('/tasks/update-task-status', [TaskApiController::class,'updateTaskStatus'])->name('updateTaskStatus');
Route::post('/tasks/delete-task', [TaskApiController::class,'deleteTask'])->name('deleteTask');