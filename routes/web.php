<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\BookController;

use Illuminate\Support\Facades\Route;

// Hello World Route
Route::get('/', function() {
    return view('helloworld');
})->name('hello.world');

// Todo Routes
Route::get('/todo', [TodoController::class, 'main'])->name('todo.main');
Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
Route::post('/todo/{id}/update', [TodoController::class, 'update'])->name('todo.update');
Route::post('/todo/{id}/declare', [TodoController::class, 'declare'])->name('todo.declare');
Route::post('/todo/{id}/delete', [TodoController::class, 'destroy'])->name('todo.destroy');

// Book Manager Routes
//BookController
Route::get('/books', [BookController::class, 'spa'])->name('books.spa');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');