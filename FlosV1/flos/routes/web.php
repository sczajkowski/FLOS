<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/', function() {
    return view('welcome');
});

Route::get('/user', function() {
    return view('user');
});

Route::get('/user/order/id', function() {
    return view('order');
});
Route::get('/order/id/category/product', function (){
    return view('product');
});
