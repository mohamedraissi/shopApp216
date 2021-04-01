<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Session;

class ProductsController extends Controller
{
    public function products(){
        Session::put('page',"products");
        $products = Product::get();
        //$products = json_decode(json_encode($products));
        //echo"<pre>"; print_r($products);
        return view('admin.products.products')->with(compact('products'));

    }
    public function updateProductStatus (Request $request){
        if ($request->ajax()){
            $data= $request->all();
            /*echo "<pre>" ; print_r($data); die;*/
           if($data['status']=="Active"){
                $status=0;
               }
           else{
               $status =1;
           }
           Product::where('id', $data ['product_id'])->update(['status'=>$status]);
           return response ()->json(['status'=>$status,'product_id'=>$data ['product_id']]);
        }
       }
       public function deleteProduct($id){
        //Delete Category 
        dd($id);
        Product::where('id',$id)->delete();
        $message = 'Product  has been deleted successfully!';
        session::flash('success_message', $message);
            return redirect()->back();
      
      }
}
