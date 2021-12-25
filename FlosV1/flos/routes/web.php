<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\OrderController;

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


//Login View

Route::get('/',[LoginController::class, 'index']);

Route::post('/', [LoginController::class, 'check'])->name('auth.check');

//Admin View

//Main
Route::get('/admin/{id}',[AdminLoginController::class, 'index'])->name('admin');

//Products
Route::get('/admin/{id}/products', [ProductController::class, 'index'])->name('admin.products');

Route::post('/admin/{id}/products', [ProductController::class, 'store']);

Route::delete('/admin/{id}/products', [ProductController::class, 'destroy'])->name('admin.products.delete');

//Tables

Route::get('/admin/{id}/tables', [TableController::class, 'index'])->name('admin.tables');

//ELSE

Route::get('/admin/products/categories', [CategoryController::class, 'index']);



//User View

Route::get('/user/{id}', [UserController::class,'index'])->name('user');

Route::post('/user/{id}', [OrderController::class, 'store']);

Route::get('/user/{id}/{orderId}', [OrderController::class, 'index'])->name('order');

Route::delete('user/{id}/{orderId}/{round}', [OrderController::class, 'destroyProduct'])->name('order.product.delete');

Route::get('/user/{id}/{orderId}/{category}', [OrderController::class, 'categoryIndex'])->name('orderCategory');

Route::post('/user/{id}/{orderId}/{category}', [OrderController::class, 'addProductsToOrder']);

Route::get('/user/order/id', function() {
    return view('order');
});
Route::get('/order/id/category/product', function (){
    return view('product');
});

