<?php

namespace App\Http\Controllers\Front;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use Auth;

class OrdersController extends Controller
{
    public function Order(){
        $orders = Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        
        return view('front.orders.orders')->with(compact('orders'));
    }

    public function OrderDetails($id){
        $orderDetails = Order::with('orders_products')->where('id',$id)->first()->toArray();
        
        return view('front.orders.order_details')->with(compact('orderDetails'));
    }
}
