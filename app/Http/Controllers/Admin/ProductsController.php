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
    public function updateproductStatus (Request $request){
        if ($request->ajax()){
            $data= $request->all();
            /*echo "<pre>" ; print_r($data); die;*/
           if($data['status']=="Active"){
                $status=0;
               }
           else{
               $status =1;
           }
           product::where('id', $data ['product_id'])->update(['status'=>$status]);
           return response ()->json(['status'=>$status,'product_id'=>$data ['product_id']]);
        }
       }
}
