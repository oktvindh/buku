<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
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

// Route untuk menampilkan daftar buku (index)
Route::get('/books', [BookController::class, 'index'])->name('books.index');

// Route untuk menampilkan form buat buku baru (create)
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

// Route untuk menyimpan data buku yang baru dibuat (store)
Route::post('/books', [BookController::class, 'store'])->name('books.store');

// Route untuk menampilkan form edit buku berdasarkan id (edit)
Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');

// Route untuk mengupdate data buku yang diubah (update)
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');

// Route untuk menghapus buku berdasarkan id (destroy)
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Route untuk menghapus buku secara massal berdasarkan checkbox yang dipilih
Route::delete('/books', [BookController::class, 'massDelete'])->name('books.massDelete');

// Route untuk mengekspor data buku ke file Excel (export)
Route::get('/books/export', [BookController::class, 'export'])->name('books.export');

// Route untuk mengimpor data buku dari file Excel (import)
Route::post('/books/import', [BookController::class, 'import'])->name('books.import');
