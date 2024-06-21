<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register_author',[UserController::class, 'registeration'])->name('register');
Route::post('/author-registeration', [UserController::class, 'create_author'])->name('register.author');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login_author', [UserController::class, 'login_author'])->name('login.author');

Route::group(['middleware'=>['auth']], function (){
    Route::get('/books-inventory', [BookController::class, 'stored_books'])->name('stored.books');
    Route::get('/download-book-pdf/{id}', [BookController::class, 'download']);
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('logOut', [UserController::class, 'logOut'])->name('logOut');
    Route::get('/book_detail/{id}', [BookController::class, 'book_details']);
    Route::get('/downloaded_books', [BookController::class, 'download_list'])->name('download.list');

});

Route::group(['middleware'=>['auth','admin']], function (){
    Route::get('/add-book', [BookController::class, 'add_new_book'])->name('add.book');
    Route::post('/submit-book', [BookController::class, 'submit_book'])->name('submit.book');
    Route::get('/book_delete/{id}', [BookController::class, 'book_delete']);
    Route::get('/users-history', [BookController::class, 'users_history'])->name('users.history');

});
