<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

//require __DIR__ . '/auth.php';

Route::middleware('guest')->group(function () {
//    Route::group(['prefix' => 'task'], function () {
//        Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('getAllTask');
//        Route::get('/create', [\App\Http\Controllers\TaskController::class, 'create'])->name('createTask');
//        Route::post('/store', [\App\Http\Controllers\TaskController::class, 'store'])->name('storeTask');
//        Route::get('/{task}', [\App\Http\Controllers\TaskController::class, 'show'])->name('showTask');
//        Route::get('/edit/{task}', [\App\Http\Controllers\TaskController::class, 'edit'])->name('editTask');
//        Route::put('/update/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('updateTask');
//        Route::delete('/delete/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('deleteTask');
//    });
    Route::patch('/tasks/priority', [\App\Http\Controllers\TaskController::class, 'updatePriority'])->name('tasks.priority');
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});
