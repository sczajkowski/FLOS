<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

        public function index($id){
            $user = User::where('id','=',$id)->first();
            $orders = Order::where('user_id','=',$id)->get();

            return view('user', compact('user', 'orders'));
        }




}
