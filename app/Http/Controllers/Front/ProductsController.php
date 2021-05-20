<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
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
            
            $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($data['product_id'],$data['size']);
            return $getDiscountedAttrPrice;
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
            if (Auth::check()){
                $user_id = Auth::user()->id;

            }else {
                $user_id = 0;
            }

            //save product in cart
          
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "product has been addedd in cart!";
            session::flash('success_message',$message);
            return redirect('cart');

        }
    }
    public function cart(){
        $userCartItems = Cart::userCartItems();
        //echo"<pre>";print_r($userCartItems); die;
        return view('front.products.cart')->with(compact('userCartItems'));
    }

public function updatetoCartItemQty(request $request){
    if ($request->ajax()){
        $data = $request->all();
        $cartDetails = Cart::find($data['cartid']);

        $avaiableStock = ProductsAttribute::select('stock')-> where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->first()->toArray();
        
if ($data['qty']>$avaiableStock['stock']){
    $userCartItems = Cart::userCartItems();
    return response()->json([
        'status'=>false,'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
    ]);
}
$avaibaleSize= ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=> 1,])->count();
if($avaibaleSize==0){
    $userCartItems = Cart::userCartItems();
    
    return response()->json([
      'status'=>false,
      
      'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
      

]);
    }  
              Cart::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
        $userCartItems = Cart::userCartItems();
        $totalCartItems = totalCartItems();
        return response()->json([
            'status'=>true,
            'totalCartItems' => $totalCartItems,
        'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))]);
        }
    }
    public function DeleteCartItem(Request $request){
        if($request->ajax()){
            $data = $request->all();
            Cart::where('id',$data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            $totalCartItems = totalCartItems();
    return response()->json([
        'totalCartItems'=>$totalCartItems,
      'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
      

]);
        }
    }
    public function applyCoupon(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $userCartItems = Cart::userCartItems();
            $couponCount = Coupon::where('coupon_code',$data['code'])->count();
            if ($couponCount==0){
                $userCartItems = Cart::userCartItems();
                $totalCartItems = totalCartItems();
                return response()->json([
                    'status'=>false,
                    'message'=>'This coupon is not valid!',
                    'totalCartItems' =>$totalCartItems,
                'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
            ]);
            }else {
                // CHECK FOR OTHER COUPON

                // GET COUPON DETAILS
                $couponDetails = Coupon::where('coupon_code',$data['code'])->first();

                //CHECK IF COUPON IS ACTIVE 
                if ($couponDetails->status==0){
                    $message = 'This coupon is not active!';
                }

                // CHECK IF COUPON IS EXPIRED


                $expiry_date = $couponDetails->expiry_date;
                $current_date = date("Y-m-d");
                if($expiry_date<$current_date){
                    $message = 'This coupon is expired!';
                }
                // CHECK COUPON IS FROM SELECTED CATERGORIES
                $catArr = explode(",",$couponDetails->categories);
                // Get cart items
                $userCartItems = Cart::userCartItems();
               
                // CHECK IF ANY ITEM BELONG TO COUPON CATEGORY 
                // CHECK THE RIGHT USER USING THE COUPON CODE
                $userArr =explode(",",$couponDetails->users);
                foreach($userArr as $user) {
                    $getUserId = User::select('id')->where('email',$user)->first()->toArray();
                    $userID[] = $getUserId['id'];
                }
                foreach ($userCartItems as $item){
                    if(!in_array($item['product']['category_id'],$catArr)){
                        $message = 'This coupon code is not for one of the selected products';
                    }
                    if(!in_array($item['user_id'],$userID)){
                        $message ="You cannot use this code!";
                    }
                }

                if(isset($message)){
                    $userCartItems = Cart::userCartItems();
                    $totalCartItems = totalCartItems();
                    return response()->json([
                        'status'=>false,
                        'message'=>$message,
                        'totalCartItems' =>$totalCartItems,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
                }

            }
        }
    }
}