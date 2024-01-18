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

Route::get('products',[ProductController::class,'list'])->name('list')->middleware('auth');

Route::get('/entry',[ProductController::class,'entry'])->name('entry');

Route::post('/store',[ProductController::class,'store'])->name('store');

Route::get('{product}/edit',[ProductController::class,'edit'])->name('edit');

Route::get('{product}/more',[ProductController::class,'more'])->name('more');

Route::patch('{product}/update',[ProductController::class,'update'])->name('update');

Route::delete('{product}/destroy',[ProductController::class,'destroy'])->name('destroy');