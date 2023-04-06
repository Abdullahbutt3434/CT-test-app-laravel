<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
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

Route::get('/', [ProductController::class,'index']);
Route::post('product/store', [ProductController::class,'store'])->name('product.store');
Route::get('product/list', [ProductController::class,'list'])->name('product.list');
Route::post('product/update', [ProductController::class,'update'])->name('product.update');
