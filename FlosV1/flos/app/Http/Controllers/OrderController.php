<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        $order->orderStatus = 'open';
        $order->save();

        return redirect()->route('order', [$user_id ,$orderId]);
    }

    function index($id, $orderId){
        $user = User::where('id','=',$id)->first();
        $categories = Category::all();

        return view('order', compact('user', 'categories', 'orderId'));
    }

    function categoryIndex($id, $orderId, $category){
        $user = User::where('id','=',$id)->first();
        $products = Product::where('category', '=' , $category)->get();
        $order = Order::where('orderId','=', $orderId)->first();

        return view('orderCategory', compact('user', 'products', 'order'));
    }

    function addProductsToOrder($id, $orderId, $category, Request $request){

        $order = Order::where('orderId','=',$orderId)->first();
        $orderCategory = Category::where('name','=',$category)->first();
        $product = Product::where('id','=',$request->productId)->first();
        $addedProducts = strval($request->productId);

        if($order->products==null)
        {
            $order->products = '{'.'"categoryId": "'.$orderCategory->id.'","category": "'.$orderCategory->name.'","productId": "'.$addedProducts.'","productName": "'.$product->productName.'","productPrice": "'.$product->price.'"}';
            $order->save();
            return back();
        }
        elseif ($order->products!=null)
        {
            $existingProducts = $order->products;
            $order->products = $existingProducts .';'. 'C'.$orderCategory->id.'['.$addedProducts.']';
            $order->save();
            return back();
        }
        else{
            return error_log('Error');
        }



    }


}
