<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('items',[ItemController::class,'list'])->name('post.list')->middleware('auth');

Route::get('items/post/entry',[ItemController::class,'entry'])->name('post.entry');

Route::post('items/post/store',[ItemController::class,'store'])->name('post.store');

Route::get('items/post/{item}/edit',[ItemController::class,'edit'])->name('post.edit');

Route::get('items/post/{item}',[ItemController::class,'more'])->name('post.more');

Route::patch('items/post/{item}/update',[ItemController::class,'update'])->name('post.update');

Route::delete('items/post/{item}/destroy',[ItemController::class,'destroy'])->name('post.destroy');