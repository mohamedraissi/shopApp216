<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use App\Models\Option;
use App\Models\ProductsAttribute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Models\DeliveryAddress;
use App\Models\Country;
use App\Models\Order;
use App\Models\OrdersProduct;
use App\Models\SMS;
use DB;
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

                if(!empty($couponDetails->users)){
                    $userArr =explode(",",$couponDetails->users);
                    foreach($userArr as $user) {
                        $getUserId = User::select('id')->where('email',$user)->first()->toArray();
                        $userID[] = $getUserId['id'];
                    }
    
                }
               
                // GET CART TOTAL AMOUNT
                $total_amount = 0;


                foreach ($userCartItems as $item){
                    if(!in_array($item['product']['category_id'],$catArr)){
                        $message = 'This coupon code is not for one of the selected products';
                    }
                    if(!empty($couponDetails->users)){
                         if(!in_array($item['user_id'],$userID)){
                            $message ="You cannot use this code!";
                    }
                }

                    $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);

                    $total_amount = $total_amount + ($attrPrice['discounted_price']*$item['quantity']);

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
                }else{
                  

                    // CHECK IF AMOUNT TYPE IS FIXED OR PERCENTAGE
                    if($couponDetails->amount_type=="Fixed"){
                        $couponAmount = $couponDetails->amount;
                        
                    }else {
                        $couponAmount = $total_amount*($couponDetails->amount/100);
                        $grand_total = $total_amount - $couponAmount;
                    }

                    
                    // ADD COUPON CODE & AMOUNT IN SESSION

                    Session::put('CouponAmount',$couponAmount);
                    Session::put('CouponCode',$data['code']);

                    $message ="Coupon code successfully applied !";
                    $totalCartItems = totalCartItems();
                    $userCartItems = Cart::userCartItems();
                    return response()->json([
                        'status'=>true,
                        'message'=>$message,
                        'totalCartItems' =>$totalCartItems,
                        'CouponAmount'=>$couponAmount,
                        'grand_total' =>$grand_total,
                        'view'=>(String)View::make('front.products.cart_items')->with(compact('userCartItems'))
                ]);
                }

            }
        }
    }
    public function checkout(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(empty($data['address_id'])){
                $message ="Please select Delivery Address!";
                Session::flash('error_message',$message);
                return redirect()->back();
            }
            if(empty($data['payment_gateway'])){
                $message ="Please select Payment method!";
                Session::flash('error_message',$message);
                return redirect()->back();
                
            }
            
            if($data['payment_gateway']=="COD"){
                $payment_method = "COD";
            }else {
                echo "Coming Soon"; die ;
                $payment_method = "Prepaid";
            }

            // GET DELVERY ADDRESS FROM ADDRESS_id
            $deliveryAddresses = DeliveryAddress::where('id',$data['address_id'])->first()->toArray();



            DB::beginTransaction();


            // INSERT ORDER DETAILS 
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddresses['name'];
            $order->address = $deliveryAddresses['address'];
            $order->city = $deliveryAddresses['city'];
            $order->state = $deliveryAddresses['state'];
            $order->country = $deliveryAddresses['country'];
            $order->pincode = $deliveryAddresses['pincode'];
            $order->mobile = $deliveryAddresses['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = 0 ;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('CouponAmount');
            $order->order_status = "New" ;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = Session::get('grand_total');
            $order->save();
            // GET LAST ORDER ID
            $order_id = DB::getPdo()->lastInsertId();
            // GET USER CART ITEMS
            $cartItems = Cart::where('user_id',Auth::user()->id)->get()->toArray();
            foreach ($cartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $getProductDetails = Product::select('product_code','product_name','product_color')->where('id',$item['product_id'])->first()->toArray();
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $getDiscountedAttrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']);
                $cartItem->product_price = $getDiscountedAttrPrice['discounted_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();


            }



             // INSERT ORDER ID IN SESSION
             Session::put('order_id',$order_id);

            DB::commit();
            if($data['payment_gateway'] == "COD"){

                // SEND SMS
               /* $message = "Dear Customer , your order ".$order_id." has been successfully placed with shop216 we will intimate you once
                your order is shipped.";
                $mobile = Auth::user()->mobile;
                SMS::sendSms($message,$mobile);*/
                $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
               

                // SEND ORDER EMAIL SCRIPT

                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails,
                    
                ];

                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - shop216');
                });
                return redirect ('/thanks');
            }else {
                echo "Prepaid method comming soon!";
            }

            echo "Order placed"; die;



        }
        $userCartItems = Cart::userCartItems();
        $deliveryAddresses = DeliveryAddress::DeliveryAddress();
        return view('layouts.Client_layout.Pages.checkout')->with(compact('userCartItems','deliveryAddresses'));
    }
  
  public function addeditdeliveryaddress($id=null,Request $request){
    if($id==""){
        $title = "Add Delivery Address";
        $address = new DeliveryAddress ;
        $message = "Delivery Address added successfully";
    }else {
        $title = "Edit Delivery Address";
        $address = DeliveryAddress::find($id);
        $message = "Delivery Address updated successfully";
    }
    if ($request->isMethod('post')){
        $data = $request->all();
         $rules = [
                    'name' =>'required |regex:/^[\pL\s\-]+$/u',
                    'address' => 'required',
                    'city' =>'required |regex:/^[\pL\s\-]+$/u',
                    'state' =>'required |regex:/^[\pL\s\-]+$/u',
                    'country' => 'required',
                    'pincode' => 'required | numeric',
                    'mobile' => 'required | numeric',
                ];
                $customMessages = [
                    'name.required' => 'Name is required',
                    'name.regex' => 'Valid Name is required',
                    'address.required' => 'Address is required',
                    'city.regex' => 'Valid City is required',
                    'state.regex' => 'Valid State is required',
                    'city.required' => 'City is required',
                    'state.required' => 'State is required',
                    'country.required' => 'Country is required',
                    'pincode.required' => 'Pincode is required',
                    'pincode.numeric' => 'Valid pincode is required',
                    'mobile.required' => 'Mobile is required',
                    'mobile.numeric' => 'Valid Phone number is required',
                    
                ];
                $this->validate($request,$rules,$customMessages);
                $address->user_id = Auth::user()->id;
                
                $address->name = $data['name'];
                $address->address = $data['address'];
                $address->city = $data['city'];
                $address->state = $data['state'];
                $address->country = $data['country'];
                $address->pincode = $data['pincode'];
                $address->mobile = $data['mobile'];
                $address->save();
            
                Session::put('success_message',$message);
                return redirect('checkout');
    }
    $countries = Country::where('status',1)->get()->toArray();
    return view('front.products.add_edit_delivery_address')->with(compact('countries','title','address'));
  }
  public function deleteeditdeliveryaddress($id){
    DeliveryAddress::where('id',$id)->delete();
    $message = "Delivery Address deleted successfully !";
    Session::put('success_message',$message);
    return redirect()->back();

  }

public function thanks(){
    if(Session::has('order_id')){

         //empty the user cart 

     Cart::where('user_id',Auth::user()->id)->delete();
     return view('front.products.thanks');

    }else {
        return redirect('/cart');
    }
    


}

}