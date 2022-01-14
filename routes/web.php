<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodolistController;
use RealRashid\SweetAlert\Facades\Alert;

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
Route::get('/home', function () {
    return view('home');
});
Route::get('todo', [TodolistController::class, 'index'])->name('index');
Route::post('todo', [TodolistController::class, 'store'])->name('store');
Route::delete('todo{todolist:id}', [TodolistController::class, 'destroy'])->name('destroy');
Route::get('todo{id}/completed', [TodolistController::class, 'completed']);

