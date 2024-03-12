<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[\App\Http\Controllers\Controller::class, 'table']);

Auth::routes();
Route::get('/home', [App\Http\Controllers\Controller::class, 'table'])->name('home');
Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'authors'])->name('authors');
Route::post('/authors/addAuthor', [App\Http\Controllers\AuthorController::class, 'addAuthor'])->name('addAuthor');
Route::post('/table/addBook', [App\Http\Controllers\Controller::class, 'addBook'])->name('addBook');
Route::delete('/table/deleteBook/{id}', [App\Http\Controllers\Controller::class, 'deleteBook'])->name('deleteBook');
Route::patch('/table/editBook/{id}', [App\Http\Controllers\Controller::class, 'editBook'])->name('editBook');
