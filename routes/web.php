<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::get('products',[ProductController::class,'list'])->name('post.list')->middleware('auth');

Route::get('products/post/entry',[ProductController::class,'entry'])->name('post.entry');

Route::post('products/post/store',[ProductController::class,'store'])->name('post.store');

Route::get('products/post/{product}/edit',[ProductController::class,'edit'])->name('post.edit');

Route::get('products/post/{product}',[ProductController::class,'more'])->name('post.more');

Route::patch('products/post/{product}/update',[ProductController::class,'update'])->name('post.update');

Route::delete('products/post/{product}/destroy',[ProductController::class,'destroy'])->name('post.destroy');