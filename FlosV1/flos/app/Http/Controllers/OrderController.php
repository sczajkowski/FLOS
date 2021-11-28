<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function unique_id($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);

        /*
         * base_convert – Convert a number between arbitrary bases.
         * sha1 – Calculate the sha1 hash of a string.
         * uniqid – Generate a unique ID.
         * mt_rand – Generate a random value via the Mersenne Twister Random Number Generator.
         */
    }

    function store($id ,Request $request){
        $user_id = $id;
        $orderId = $this->unique_id(9);

        $order = new Order();
        $order->orderId = $orderId;
        $order->user_id = $user_id;
        $order->table = $request->table;
        $order->status = 'open';
        $order->save();

        redirect('/user/{id}/',$orderId);
    }


}
