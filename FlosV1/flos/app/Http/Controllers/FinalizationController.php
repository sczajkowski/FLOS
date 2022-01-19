<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class FinalizationController extends Controller
{
    function finalization($id, $orderId,Request $request){
        $user = User::where('id','=',$id)->first();
        $order = Order::where('orderId','=', $orderId)->first();
        $orders = Order::where([['user_id','=',$id],['orderStatus', '=', 'open']])
            ->get();
        $order->paymentMethod = $request->paymentMethod;
        $order->orderStatus = "closed";
        $order->save();
        return view('user', compact('user', 'orders'));
    }
}
