<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Models\Listing;
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


/** Common route convention
 * index - show all
 * show - show one
 * create - show form for adding new
 * store - store new
 * edit - show form for updating
 * update - update
 * destroy - delete
 */


Route::get('/', [ListingController::class, 'index'])->name('index');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('show');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('edit')->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('update');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('delete');
Route::get('/create', [ListingController::class, 'create'])->name('create')->middleware('auth');
Route::post('/store', [ListingController::class, 'store'])->name('store')->middleware('auth');


Route::get('/manage', [ListingController::class, 'manage'])->name('manage')->middleware('auth');


// user auth 
Route::get('/register', [UserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/users', [UserController::class, 'store'])->name('users')->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/authenticate', [UserController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
