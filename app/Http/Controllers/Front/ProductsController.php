<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use Session;
use Auth;

class ProductsController extends Controller
{
    public function listing(Request $request){
        if($request->ajax()){
            $data=$request->all();
           // echo "<pre>";print_r($data);die;
            $url=$data['url'];
            $categoryCount = Category::where(['url'=>$url,'status'=>1])-> count();
            $categoryDetails = Category::categoryDetails($url);
            $categoryProducts = Product::with(['brand','options','values'])->whereIn('category_id', $categoryDetails['catIds'])
               ->where('status',1);
                /* echo "<pre>";dd($categoryProducts->whereHas('values', function ($query) use ($data) {
                    return $query->whereIn('id',$data['filter']);
                })->get()->toArray());die;*/
            if($categoryCount>0){
               $categoryDetails = Category::categoryDetails($url);
               $categoryProducts = Product::with(['brand'])->whereIn('category_id', $categoryDetails['catIds'])
               ->where('status',1);
               
               //if Fabric filter is selected 
               if (isset($data['filter']) && !empty($data['filter'])) {
                $categoryProducts->whereHas('values', function ($query) use ($data) {
                    return $query->whereIn('id',$data['filter']);
                })->get()->toArray();
               }
               //if sort ooption selected by user
               if (isset($data['sort']) && !empty($data['sort'])) {
                   if ($data['sort']=="product_latest") {
                    $categoryProducts->orderBy("id","Desc");
                   }
                  
                else if($data['sort']=="product_latest"){
                    $categoryProducts->orderBy("id","Desc");
                }
                else if($data['sort']=="product_name_a_z"){
                    $categoryProducts->orderBy("product_name","Asc");
                }
                else if($data['sort']=="product_name_z_a"){
                    $categoryProducts->orderBy("product_name","Desc");
                }
                else if($data['sort']=="price_lowest"){
                    $categoryProducts->orderBy("product_price","Asc");
                }
                else if($data['sort']=="price_highest"){
                    $categoryProducts->orderBy("product_price","Desc");
                }
               }
               else{
                $categoryProducts->orderBy("id","Desc");
               }
               $categoryProducts= $categoryProducts->paginate(3);
               /*echo "<pre>"; print_r($categoryProducts);die;*/
               return view('front.products.ajax_products_listing')->with(compact('categoryDetails','categoryProducts','url'));
    
            }else{
                abort(404);
            }
        }
        else{
            $url=Route::getFacadeRoot()->current()->uri();
            $options=Option::with('values')->get();
            $categoryCount = Category::where(['url'=>$url,'status'=>1])-> count();
            if($categoryCount>0){
               $categoryDetails = Category::categoryDetails($url);
               $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])
               ->where('status',1);
               //if sort ooption selected by user
               $categoryProducts= $categoryProducts->paginate(3);
               /*echo "<pre>"; print_r($categoryProducts);die;*/

                //product arrays
                $productFilters=Product::productFilters();
                $fabricArray=$productFilters['fabricArray'];
                $sleeveArray=$productFilters['sleeveArray'];
                $patternArray=$productFilters['patternArray'];
                $fitArray=$productFilters['fitArray'];
                $occassionArray=$productFilters['occassionArray'];
                 
                $page_name="listing";

               return view('front.products.listing')->with(compact('categoryDetails','categoryProducts','url','page_name','options'));
    
            }else{
                abort(404);
            }
    
        }
       
    }
    public function detail($id){
        $productDetails = Product::with(['category','brand','attributes'=>function($query){$query->where('status',1);},'images'])->find($id)->toArray();
        //dd($productDetails); die;
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');
        return view('front.products.detail')->with(compact('productDetails','total_stock'));
    }
    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data = $request->all();
           // echo "<pre>";print_r($data);die;
            $getProductPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'
            =>$data['size']])->first();
            return $getProductPrice->price;
        }
    }

    public function addtocart(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            //check product stock is available or not
            $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],
            'size'=>$data['size']])->first()->toArray();
             if($getProductStock['stock']<$data['quantity']){
                $message = "Required qauntity is not available!";
                session::flash('error_message',$message);
                return redirect()->back();
            }
            // generate session id if not exists
            $session_id = Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }
            // Check product if already exists in cart
            if(Auth::check()){
                //User is logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],
                'user_id'=>Auth::user()->id])->count();
            }else{
                //iser is not logged in
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],
                'session_id'=>Session::get('session_id')])->count();
            }
           
            if($countProducts>0){
                $message = "Product already exists in cart!";
                session::flash('error_message',$message);
                return redirect()->back();
            }


            //save product in cart
          
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "product has been addedd in cart!";
            session::flash('success_message',$message);
            return redirect()->back();

        }
    }
    public function cart(){
        $userCartItems = Cart::userCartItems();
        //echo"<pre>";print_r($userCartItems); die;
        return view('front.products.cart')->with(compact('userCartItems'));
    }

}
