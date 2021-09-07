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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*Route::get('user',function(){
    return 'User';
});*/
Route::get("/user",[UserController::class,"index"])->middleware('user');
Route::view('user','homeUser')->name('user');

/*Route::get('admin',function(){
    return 'admin';*/
Route::get("/admin",[AdminController::class,"index"])->middleware('admin');
Route::view('admin','homeAdmin');

Route::get('neworder',[App\Http\Controllers\NewOrderController::class,'index'])->name('neworder');
Route::post('user:complete',[App\Http\Controllers\NewOrderController::class,'newOrder'])->name('makeNewOrder');
Route::get('orderItems',[App\Http\Controllers\NewOrderController::class,'index1'])->name('orderItems');
Route::post('orderItems',[App\Http\Controllers\NewOrderController::class,'orderItems'])->name('addOrderItems');
Route::post('orderItems:deleted',[App\Http\Controllers\NewOrderController::class,'deleteItems'])->name('delete_order_item');
Route::post('orderItems:submit',[App\Http\Controllers\NewOrderController::class,'submitOrder'])->name('submitOrder');

Route::get('user:list',[App\Http\Controllers\NewOrderController::class,'orderList'])->name('order_list');
Route::post('user:list',[App\Http\Controllers\NewOrderController::class,'deleteOrder'])->name('delete_order');