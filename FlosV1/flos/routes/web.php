<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\ProductController;

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

//Panel Administratora(Kierownika)

Route::get('/admin', function() {
    return view('admin.admin');
});

Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products');

Route::post('/admin/products', [ProductController::class, 'store']);

Route::get('/admin/products/categories', );





Route::get('/', function() {
    return view('welcome');
});

//Route::get('/', [UserController::class, 'login']);

Route::post('/',[UserController::class, 'login']);

Route::get('/user', function() {
    return view('user');
});

Route::get('/user/order/id', function() {
    return view('order');
});
Route::get('/order/id/category/product', function (){
    return view('product');
});

