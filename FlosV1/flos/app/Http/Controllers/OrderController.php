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

            $jsonProducts  = json_encode($arrProducts);   // Its necessary to convert array of values to object using json encode and decode
            $objectProducts = json_decode($jsonProducts);
            $arr = array('0' => $objectProducts);   //Here we need to define array of objects that will be foreached to get correct amount of order

            $order->amount = $this->priceUpdate($arr);
            $productsJson =  json_encode($arrProducts);
            $order->products = '['.$productsJson.']';
        }
        elseif ($order->products!=null)
        {
            $newProduct = array('categoryId' => $orderCategoryString, 'category' => $orderCategory->name, 'productId' => $addedProducts, 'productName' => $product->productName, 'productPrice' => $product->price);
            $newProductJson = json_encode($newProduct);
            $previousProducts = $order->products;

            //Offsetting the Order->products value (deleting closing square brackets = "]" to add product to Array of products)
            $rest = substr($previousProducts, 0, -1);

            $var = $rest.','.$newProductJson.']'; //Adding new product to the array of objects
            $order->amount = $this->priceUpdate(json_decode($var));
            $order->products = $var;

        }
        else{
            return error_log('Error');
        }
        //Here we need to generate price to Price for whole order

        $order->save();
        return back();



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
        $order->amount = $this->priceUpdate($arr2);

        if(count($arr2)==0){        //If the table is empty products column need to have '{}' value to get an empty object
            $empty = '{}';
            $order->products = $empty;

        }
        else{//If the table isn't empty it just delete foreached product and create new table with new iteration and save changes it to database

            $json = json_encode($arr2);
            $order->products = $json;

        }

        $order->save();
        return back();

    }

    function priceUpdate($table){
        $summary = 0;   //Reset Value of summary
        foreach ($table as $thisRecord){
            $priceString = $thisRecord->productPrice;
            $priceFloat = (float)$priceString;
            $summary += $priceFloat;
        }
        $summaryString = (string)$summary;
        return $summaryString;
    }


}
