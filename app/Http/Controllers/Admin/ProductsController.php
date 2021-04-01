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
        $products = Product::with(['category'=> function($query){
            $query->select('id','category_name');
        }
        ,'section'=>function($query){
            $query->select('id','name');
        }])->get();
        //$products = json_decode(json_encode($products));
        //echo"<pre>"; print_r($products);
        //dd( $products);
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
      public function addEditProduct(Request $request,$id=null){
        if ($id==""){
            //Add Product Functionality
             $title="Add Product";
             $product = new Product;
             $productdata = array();
             $getProducts=array();
             $message ="category added successfully!";
        }
        else{
            $title="Edit Product";
        }

        //filter arrays
        $fabricArray=array('cotton','polyester','wool');
        $sleeveArray=array('full seleeve','half seleeve','short seleeve');
        $patternarrayArray=array('checked','plain','printed');
        $occassionArray=array('Regular','slim');
        $occassionArray=array('casual','formal');
        return view('admin.products.add_edit_product')->with(compact(['title','productdata','getProducts']));
      }
}
