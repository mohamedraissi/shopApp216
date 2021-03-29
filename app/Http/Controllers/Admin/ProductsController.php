<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function products(){
        $products = Product::get();
        //$products = json_decode(json_encode($products));
        //echo"<pre>"; print_r($products);
        return view('admin.products.products')->with(compact('products'));

    }
}
