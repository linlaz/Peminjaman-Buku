<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;

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

Route::get('/', [BookController::class, 'indexpage'])->name('indexbook');
Route::get('/detail/{idbook}', [BookController::class, 'detailpage'])->name('detailbook');
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/borrow', [BookController::class, 'detailborrow'])->name('detailborrow');
});


Route::get('/dashboard', [BorrowController::class, 'index'])->middleware(['auth:sanctum', 'verified', 'role_or_permission:admin'])->name('indexbookdashboard');
// Route::middleware(['auth:sanctum', 'verified', 'role_or_permission:admin'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group(['prefix' => '/dashboard', 'middleware' => ['auth:sanctum', 'role_or_permission:admin']], function () {

    Route::group(['prefix' => '/book'], function () {
        Route::get('/', [BookController::class, 'index'])->name('indexbookdashboard');
        Route::get('/create', [BookController::class, 'create'])->name('createbookdashboard');
        Route::post('/store', [BookController::class, 'store'])->name('storebookdashboard');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('editbookdashboard');
        Route::post('/update', [BookController::class, 'update'])->name('updatebookdashboard');
        Route::get('/{id}/show', [BookController::class, 'detailpage'])->name('showbookdashboard');
    });

    Route::group(['prefix' => '/publisher'], function () {
        Route::get('/', [PublisherController::class, 'index'])->name('indexpublisherdashboard');
    });

    Route::group(['prefix' => '/author'], function () {
        Route::get('/', [AuthorController::class, 'index'])->name('indexauthordashboard');
    });
    Route::group(['prefix' => '/category'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('indexcategorydashboard');
    });
    Route::group(['prefix' => '/role'], function () {
        Route::get('/', [UserController::class, 'roleindex'])->name('indexroledashboard');
    });
    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('indexuserdashboard');
    });
});
