<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\BookController;

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

Route::controller(BookController::class)->group(function(){
    Route::get('/all/book','AllBook')->name('all.book');
    Route::get('/add/book','AddBook')->name('add.book');
    Route::post('/store/book','StoreBook')->name('store.book');
    Route::get('/edit/book/{id}','EditBook')->name('edit.book');
    Route::post('/update/book','UpdateBook')->name('update.book');
    Route::post('/update/book/thumbnail','UpdateBookThumbnail')->name('update.book.thumbnail');
    Route::get('/delete/book/{id}','DeleteBook')->name('delete.book');
    Route::get('/books/export','export')->name('export.book');
    Route::post('/books/import','import')->name('import.book');

});
