<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use App\Models\Brand;
class Dashboard extends Controller
{
    public function dashboard(){
        Session::put('page',"dashboard");
        $nbrecategory=Category::count();
        $nbresection=Section::count();
        $nbreproducts = Product::count();
        $products = Product::with([ 'brand','category'=> function($query){
            $query->select('id','category_name');
        }
        ,'section'=>function($query){
            $query->select('id','name');
        }])->inRandomOrder()->limit(5)->get();
        dd($products);
         return view('dashboard')->with(compact('products','nbrecategory','nbresection','nbreproducts'));
     }  
}
