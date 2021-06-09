<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\OrderStatus;
use App\Models\OrdersLog;
use App\Models\Order;
use App\Models\User;
use Session;
class OrdersController extends Controller
{
    public function Orders(){
        Session::put('page',"orders");
        $orders = Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
        //echo"<pre>"; print_r($orders);die;
        return view('admin.orders.orders')->with(compact('orders'));
    }


    public function orderDetails($id){
        Session::put('page',"orders");
        $orderDetails = Order::with ('orders_products')->where('id',$id)->first()->toArray();
        $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
        $orderStatus = OrderStatus::where('status',1)->get()->toArray();
        $orderLog= OrdersLog::where('order_id',$id)->orderBy('id','Desc')->get()->toArray();
        
        return view ('admin.orders.order_details')->with(compact('orderDetails','userDetails','orderStatus','orderLog'));
    }

    public function UpdateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            Session::put('success_message','Order Status has been updated Successfully!');
// UPDATE COURIER NAME AND TRACKING NUMBER 
     
            if(!empty($data['courier_name'])&& !empty($data['tracking_number'])){
                Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracking_number'
                ]]);
            }

}


            $deliveryDetails = Order::select('mobile','email','name')->where('id',$data['order_id'])->first()->toArray();

            $orderDetails = Order::with('orders_products')->where('id',$data['order_id'])->first()->toArray();


            //SEND ORDER STATUS USING EMAIL
            $email = $deliveryDetails['email'];
                $messageData = [
                    'email' => $email,
                    'name' => $deliveryDetails['name'],
                    'order_id' => $data['order_id'],
                    'oreder_status' => $data['order_status'],
                    'courier_name' => $data['courier_name'],
                    'tracking_number' => $data['tracking_number'],
                    'orderDetails' => $orderDetails,
                    
                ];

                Mail::send('emails.order_status',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Status Updated - shop216');
                });
// UPDATE ORDER LOGS 
                $log = new OrdersLog;
                $log->order_id = $data['order_id'];
                $log->order_status = $data['order_status'];
                $log->save();

            return redirect()->back();
        }
        public function viewOrderInvoice($id){
            $orderDetails = Order::with ('orders_products')->where('id',$id)->first()->toArray();
            $userDetails = User::where('id',$orderDetails['user_id'])->first()->toArray();
            
            return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
    }   

    }
    

