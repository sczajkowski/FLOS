<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    function store(Request $request){

        $data = $request->all();
        $category = $request->input('category');
        $productName = $request->input('productName');
        $price = $request->input('price');

        $data = Product::create($data);

        return redirect('admin/products');
    }

    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products', compact('products','categories'));
    }
}
