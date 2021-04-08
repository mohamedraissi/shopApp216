<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Session;
use Image;

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
       public function deleteProduct($product,$id){
        //Delete Category 
        //dd($id);
        Product::where('id',$id)->delete();
        $message = 'Product '.$product.' has been deleted successfully!';
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
             $message ="product added successfully!";
        }
        else{
            $title="Edit Product";
            $productdata = Product::find($id);
            $productdata = json_decode(json_encode($productdata),true);
            //echo"<pre>"; print_r($productdata);
            $product = Product::find($id);
            $message ="product update successfully!";
        }
        if ($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>";print_r($data); die;
            //product Validation 
     $rules =[
        'category_id' => 'required',
        'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
        'product_code' => 'required|regex:/^[\w-]*$/',
        'product_price' =>'required|numeric',
        
        
        
     ];
     $customMessages =[
        'category_id.required' =>'Category  is required',
        'product_name.required'=>' product Name is required',
        'product_name.regex' =>' Valid product Name is required',
        'product_code.required'=>' product code is required',
        'product_code.regex' =>' Valid product code is required',
        'product_price.required'=>' product price is required',
        'product_price.numeric' =>' Valid product price is required',
     
        
     ];
     $this->validate($request,$rules,$customMessages);

     //upload product image
     $image_name="";
     if($request->hasFile('main_image')){
         $image_tmp = $request->file('main_image');
         if($image_tmp->isValid()){
             //get original image name
             $image_name = pathinfo($image_tmp->getClientOriginalName(),PATHINFO_FILENAME);
             //get image extension
             $extension = $image_tmp->getClientOriginalExtension();
             //dd($image_name);
             //generate new image name
             $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;
             //set paths for small , medium and large images
             $large_image_path = 'images/product_images/large/'.$imageName;
             $medium_image_path = 'images/product_images/medium/'.$imageName;
             $small_image_path = 'images/product_images/small/'.$imageName;
             //upload large image
             Image::make($image_tmp)->save($large_image_path); //w:1040 H:1200
             //upload medium and small images after resize
             Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
             Image::make($image_tmp)->resize(260,300)->save($small_image_path);
             //save product main image in product table
             $product->main_image = $imageName;

         }
     }
     //upload product video
     $video_name="";
     if($request->hasFile('product_video')){
         $video_tmp = $request->file('product_video');
         if($video_tmp->isValid()){
             //upload video
             $video_name = $video_tmp->getClientOriginalName();
             $extension = $video_tmp->getClientOriginalExtension();
             $videoName = $video_name.'-'.rand().'.'.$extension;
             $video_path = 'videos/product_videos/';
             $video_tmp->move($video_path,$videoName);
             //save video in products table
             $product->product_video = $videoName;

         }
     }

     //save product in products table
     if(empty($data['product_discount'])){
        $data['product_discount']=0;
      }
     
      if(empty($data['product_description'])){
        $data['product_description']="";
      }
      if(empty($data['product_meta_description'])){
        $data['product_meta_description']="";
      }
      if(empty($data['product_meta_keyword'])){
        $data['product_meta_keyword']="";
      }

     $categoryDetails = Category::find($data['category_id']);
    // dd( $categoryDetails->section_id);
     //$product->section_id = $categoryDetails[' categoryDetails->section_id)'];
     $product->section_id=$categoryDetails->section_id;
     $product->category_id = $data['category_id'];
     $product->product_name = $data['product_name'];
     $product->product_code = $data['product_code'];
     $product->product_price = $data['product_price'];
     $product->product_discount = $data['product_discount'];
     $product->product_description = $data['product_description'];
     $product->product_meta_description = $data['product_meta_description'];
     $product->product_meta_keyword = $data['product_meta_keyword'];
     $product->status=1;
     
     $product->save();
     session::flash('success_message',$message);
     return redirect('admin/products');

        }

        //filter arrays
        /* $fabricArray=array('cotton','polyester','wool');
        $sleeveArray=array('full seleeve','half seleeve','short seleeve');
        $patternArray=array('checked','plain','printed');
        $fitArray=array('Regular','slim');
        $occassionArray=array('casual','formal'); */

        //sections with categories and subcategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories),true);
        //echo"<pre>"; print_r($categories);die;


        return view('admin.products.add_edit_product')->with(compact(['title','categories','productdata']));
      }

      public function deleteProductImage($id){
        //Get product Image 
        $productImage = Product::select ('main_image')->where ('id',$id)-> first();
        //Get product Image Path
        $small_image_path ='images/product_images/small/';
        $medium_image_path ='images/product_images/medium/';
        $large_image_path ='images/product_images/large/';
        //Delete product Image  from product_images folder if exists
        if (file_exists($small_image_path.$productImage->main_image)){
          unlink($small_image_path.$productImage->main_image);
        }
        if (file_exists($medium_image_path.$productImage->main_image)){
            unlink($medium_image_path.$productImage->main_image);
          }
          if (file_exists($large_image_path.$productImage->main_image)){
            unlink($large_image_path.$productImage->main_image);
          }  
          
        //Delete Product image from products table
        Product::where('id',$id)->update(['main_image'=>'']);
      
        $message ='Product image has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
      }

      public function deleteProductVideo($id){
        //Get product video 
        $productVideo = Product::select ('product_video')->where ('id',$id)-> first();
        //Get product video Path
        $product_video_path ='videos/product_videos/';
        //Delete product video  from product_video folder if exists
        if (file_exists($product_video_path.$productVideo->product_video)){
          unlink($product_video_path.$productVideo->product_video);
        }
        //Delete productvideo from categories tale
        Product::where('id',$id)->update(['product_video'=>'']);
      
        $message ='product video has been deleted successfully!';
        session::flash('success_message', $message);
        return redirect()->back();
      }
}
