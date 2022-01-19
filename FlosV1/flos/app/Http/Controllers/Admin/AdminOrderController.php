<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function index($id){
        $user = User::where('id','=',$id)->first();
        $orders = Order::all();
        return view('admin.orders', compact('user','orders'));
    }
}
