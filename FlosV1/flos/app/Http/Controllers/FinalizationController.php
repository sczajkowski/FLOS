<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class FinalizationController extends Controller
{
    function finalization($id, $orderId){
        $user = User::where('id','=',$id)->first();
        $order = Order::where('orderId','=', $orderId)->first();
        dd('casanova');
    }
}
