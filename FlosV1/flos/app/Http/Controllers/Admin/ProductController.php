<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function store(Request $request){

        //$data = $request->all();

        if (isset($_POST['productName'])){
            $data = $request->all();
            Product::create($data);
        }
        elseif (isset($_POST['name'])){
            $data = $request->all();
            Category::create($data);
        }
        else{
            return "Error 500 Abort";
        }

        return redirect('admin/products');
    }

    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products', compact('products','categories'));
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/admin/products');
    }
}
