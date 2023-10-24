<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});
//admin hozzá férhet
Route::middleware( ['admin'])->group(function () {
    Route::apiResource('/users', UserController::class);
});
//bejelenkezett felhasznaló
Route::middleware('auth.basic')->group(function () {
    Route::apiResource('api/copies', CopyController::class);
    Route::apiResource('api/books', BookController::class);
    Route::get('with/book_copy',[BookController::class, 'bookCopy']);
    Route::get('/with/lending_user',[LendingController::class, 'lendingUser']);
    Route::get('/with/copybooklending',[CopyController::class,'copyBookLending']);
    Route::get('/with/lendingusertime/{start}',[LendingController::class,'lendingUserTime']);
});

//bárki bejelentkezés nélkül elérheti
Route::apiResource('api/copies', CopyController::class);
Route::apiResource('api/books', BookController::class);
Route::apiResource('api/users', UserController::class);

Route::patch('/api/update_password/{id}', [UserController::class, 'updatePassword']);
Route::delete('/api/user_password/{user_id}/{copy_id}/{start}',[LendingController::class,'destroy']);

Route::get('/copy/new', [CopyController::class, 'newView']);
Route::get('/copy/edit/{id}', [CopyController::class, 'editView']);
Route::get('/copy/list', [CopyController::class, 'listView']);

require __DIR__.'/auth.php';
