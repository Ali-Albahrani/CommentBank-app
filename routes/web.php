<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\commentBankCRUDController;

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
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/comments', function () {
    return view('comments');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/comment-bank', function () {
    return view('comment-bank');
})->middleware(['auth', 'verified'])->name('comment-bank');

Route::get('comment-bank', [commentBankCRUDController::class, 'index']);
Route::get('comments', [commentBankCRUDController::class, 'readComments']);
Route::post('save-comment', [commentBankCRUDController::class, 'store']);
Route::get('fetch-comments', [commentBankCRUDController::class, 'fetchComments']);
Route::get('edit-comment/{id}', [commentBankCRUDController::class, 'edit']);
Route::put('update-comment/{id}', [commentBankCRUDController::class, 'update']);
Route::delete('delete-comment/{id}', [commentBankCRUDController::class, 'destroy']);

require __DIR__ . '/auth.php';
