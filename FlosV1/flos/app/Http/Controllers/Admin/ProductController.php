<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Dodawanie Produktu lub Kategorii do Bazy

    function store(Request $request){

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

    //Wyświetlanie PRoduct View wraz ze zmiennymi

    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products', compact('products','categories'));
    }

    //Usuwanie Produktu

    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/admin/products');
    }
}
