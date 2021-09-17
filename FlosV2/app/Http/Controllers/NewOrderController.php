<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class NewOrderController extends Controller
{
    public function index(){
        return view('newOrder');
    }

    public function index1(){
        return view('orderItems');
    }

    public function newOrder(Request $request){
        $table = $request->table;

        if(isset(Auth::user()->role)){
        
        $insert = DB::insert('INSERT INTO orders (waiter, tabl)
        VALUES ('.Auth::user()->id.','.$table.')');
        $error = 'Wykonano';

        $order_id = DB::table('orders')->latest('id')->first();

        $data = $order_id->id;
        
        $insert = DB::insert('INSERT INTO order_waiter (order_id, waiter_id)
        VALUES('.$data.','.Auth::user()->id.')');

        $request=null;
        }
        return view('orderItems')->with('order_id',$data);
    }

    public function orderItems(Request $request){
        $order_id = $request->order_id;
        $item_id = $request->item_id;
        $quantity = $request->item_quantity;

        $item = DB::table('item')->where('id', $item_id)->first();
        $price = $item->price;
        $sumprice = $price*$quantity;

        $insert = DB::insert('INSERT INTO order_items (order_id, item_id, quantity,price)
        VALUES('.$order_id.','.$item_id.','.$quantity.','.$sumprice.')');

        $select = DB::select('SELECT distinct oi.item_id,it.name,it.price, oi.quantity,oi.quantity*it.price as total_item_price 
        FROM order_items oi inner join item it where it.id=oi.item_id and order_id='.$order_id.'' );

        return view('orderItems', ['order_id' => $order_id])->with('itemList',$select);
    }

    public function deleteItems(Request $request){
        $order_id = $request->order_id;
        $delete_id = $request->delete_id;
        $quantity = $request->quantity;
        $delete = DB::table('order_items')->where('order_id', '=', $order_id)->where('item_id', '=', $delete_id)->where('quantity', '=', $quantity)->delete();

        $select = DB::select('SELECT distinct oi.item_id,it.name,it.price, oi.quantity,oi.quantity*it.price as total_item_price 
        FROM order_items oi inner join item it where it.id=oi.item_id and order_id='.$order_id.'' );

        return view('orderItems', ['order_id' => $order_id])->with('itemList',$select);
    }

    public function orderList(){
        $id = Auth::user()->id;
        $select = DB::select('select * from orders where waiter='.$id.'');

        return view('homeUser')->with('orderList',$select);
    }

    public function deleteOrder(Request $request){
        $order_id = $request->order_id;

        $delete = DB::table('orders')->where('id', '=', $order_id)->delete();
        $delete = DB::table('order_items')->where('order_id', '=', $order_id)->delete();
        $delete = DB::table('order_waiter')->where('order_id', '=', $order_id)->delete();

        $id = Auth::user()->id;
        $select = DB::select('select * from orders where waiter='.$id.'');

        return view('homeUser')->with('orderList',$select);
    }

    public function submitOrder(Request $request){
        $order_id = $request->order_id;
        $price = DB::table('order_items')->where('order_id', $order_id)->sum('price');

        DB::update('update orders set price = ? where id = ?', [$price,$order_id]);

        $id = Auth::user()->id;
        $select = DB::select('select * from orders where waiter='.$id.'');

        return view('homeUser')->with('orderList',$select);
    }

}
