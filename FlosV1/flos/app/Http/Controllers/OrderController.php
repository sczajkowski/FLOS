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
        $order->products= '{}';
        $order->orderStatus = 'open';
        $order->save();

        return redirect()->route('order', [$user_id ,$orderId]);
    }

    function index($id, $orderId){
        $user = User::where('id','=',$id)->first();
        $categories = Category::all();
        $order = Order::where('orderId','=', $orderId)->first();
        $var = json_decode($order->products);
        $round = 0;
        return view('order', compact('user', 'categories', 'order', 'var', 'orderId', 'round'));
    }

    function categoryIndex($id, $orderId, $category){
        $user = User::where('id','=',$id)->first();
        $products = Product::where('category', '=' , $category)->get();
        $order = Order::where('orderId','=', $orderId)->first();
        $var = json_decode($order->products);
        $round = 0;
        return view('orderCategory', compact('user', 'products', 'order','var', 'round', 'orderId'));
    }

    function addProductsToOrder($id, $orderId, $category, Request $request){

        $order = Order::where('orderId','=',$orderId)->first();
        $orderCategory = Category::where('name','=',$category)->first();
        $product = Product::where('id','=',$request->productId)->first();
        $addedProducts = strval($request->productId);
        $orderCategoryString = strval($orderCategory->id);
        if($order->products=='{}')
        {
            $arrProducts = array('categoryId' => $orderCategoryString, 'category' => $orderCategory->name, 'productId' => $addedProducts, 'productName' => $product->productName, 'productPrice' => $product->price);
            $productsJson =  json_encode($arrProducts);
            $order->products = '['.$productsJson.']';
            $order->save();
            return back();
        }
        elseif ($order->products!=null)
        {
            $newProduct = array('categoryId' => $orderCategoryString, 'category' => $orderCategory->name, 'productId' => $addedProducts, 'productName' => $product->productName, 'productPrice' => $product->price);
            $newProductJson = json_encode($newProduct);
            $previousProducts = $order->products;
            //Offsetting the Order->products value (deleting closing square brackets = "]" to add product to array)
            $rest = substr($previousProducts, 0, -1);

            $var = $rest.','.$newProductJson.']'; //Adding new product to the array of objects

            $order->products = $var;
            $order->save();
            return back();

        }
        else{
            return error_log('Error');
        }



    }

    function destroyProduct($id, $orderId, $round, Request $request){
        //Usunięcie produktu z JSONA ($order->products)
        //$product = $request->deletedProductName;
        $order = Order::where('orderId','=',$orderId)->first();
        $arrayOfProducts = json_decode($order->products);
        //find object selected to delete
        unset($arrayOfProducts[$round-1]); //deleting object from array

        if($arrayOfProducts=='[]'){
        $arrayOfProducts[$round]='{}';
        }

        $arr2 = array_values($arrayOfProducts); //creating new table with corectly sorted id's

        if(count($arr2)==0){        //If the table is empty products column need to have '{}' value to get an empty object
            $empty = '{}';
            $order->products = $empty;
            $order->save();
            return back();
        }
        else{   //If the table isnt empty it just delete foreached product and create new table with new iteration and save changes it to database
            $json = json_encode($arr2);

            $order->products = $json;
            $order->save();

            //$order = Order::findOrFail($orderId);
            //dd($order);
            return back();
        }


    }


}
