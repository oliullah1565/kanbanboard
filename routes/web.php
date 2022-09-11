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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\TaskController::class, 'index'])->name('dashboard');

Route::post('/task/store', [App\Http\Controllers\TaskController::class, 'store'])->name('taskstore');

Route::get('/inprocess/{id}', [App\Http\Controllers\TaskController::class, 'inprocess'])->name('inprocess');

Route::get('/done/{id}', [App\Http\Controllers\TaskController::class, 'done'])->name('done');


