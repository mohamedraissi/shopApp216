<?php  use App\models\Product; ?>
@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
@if(Session::has('success_message'))
			<div class="alert alert-success" role="alert">
             {{ Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>
             {{ Session::forget('success_message') }}
        @endif
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
                   
							<div class="title">
								<h4>Orders #{{ $orderDetails['id'] }} Details</h4>
                            </div>
    							<br>
                                <br>
                               
                                <h3 class="card-title"> Customer Details</h3>
                            </div>
                            
                            <table class="table col-md-12">
                                <tr>
                                    <td>Name</td>
                                    <td>{{$userDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$userDetails['email'] }}</td>
                                </tr>
                                <tr>
                               </table> 					
                               <table class="table table-striped table-bordered col-md-12">
                                <tr>
                                    <td colspan="2"><strong>Billing Address</strong></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$userDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$userDetails['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{$userDetails['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>{{$userDetails['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$userDetails['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>Pincode</td>
                                    <td>{{$userDetails['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>{{$userDetails['mobile'] }}</td>
                                </tr>
				</table>
                        
				<h2 class="h4 pd-20">Order Details</h2>
				
                              <table class="table table-striped table-bordered col-md-12">
                                <tr>
                                    <td>Order Date</td>
                                    <td> {{ date('d-m-Y', strtotime($orderDetails['created_at'])) }} </td>
                                </tr>
                                <tr>
                                    <td>Order Status</td>
                                    <td>{{ $orderDetails['order_status'] }}</td>
                                </tr>
                                @if (!empty($orderDetails['courier_name']))  
                                <tr>
                                    <td>Courier Name </td>
                                    <td>{{ $orderDetails['courier_name'] }}</td>
                                </tr>
                                @endif 
                                @if (!empty($orderDetails['tracking_number']))  
                                <tr>
                                    <td>Tracking Number</td>
                                    <td>{{ $orderDetails['tracking_number'] }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Order Total</td>
                                    <td>${{ $orderDetails['grand_total'] }}</td>
                                </tr>
                                <tr>
                                    <td>Shipping Charges</td>
                                    <td>${{$orderDetails['shipping_charges'] }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Code</td>
                                    <td>{{$orderDetails['coupon_code'] }}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Amount</td>
                                    <td>{{$orderDetails['coupon_amount'] }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>{{$orderDetails['payment_method'] }}</td>
                                </tr>
                                <tr>
                                    <td>Payment Gateway</td>
                                    <td>{{$orderDetails['payment_gateway'] }}</td>
                                </tr>

                            </table>

                        
                        <br>
                       
                            <div class="span4">
                              <table class="table table-striped table-bordered">
                                <tr>
                                    <td colspan="2"><strong>Delivery Address</strong></td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{$orderDetails['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$orderDetails['address'] }}</td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>{{$orderDetails['city'] }}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>{{$orderDetails['state'] }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$orderDetails['country'] }}</td>
                                </tr>
                                <tr>
                                    <td>Pincode</td>
                                    <td>{{$orderDetails['pincode'] }}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>{{$orderDetails['mobile'] }}</td>
                                </tr>
				</table>
            </div>
              
                            <div class="span8">
                                <table class="table table-striped table-bordered">
                                    <tr>
                                        <th> Product Image </th>
                                        <th> Product Code </th>
                                        <th> Product Name </th>
                                        <th> Product Size  </th>
                                        <th> Product Color  </th>
                                        <th> Product Qty   </th>
                                        
                        </tr>
                        @foreach($orderDetails['orders_products'] as $product)
                        <tr>
                                        <td>
                                        <?php $getProductImage = Product::getProductImage($product['product_id']) ?>
                                        <a  target="_blank" href="{{ url('product/'.$product['product_id']) }}" > <img style="width: 80px; " 
                                        src="{{ asset('/images/product_images/small/'.$getProductImage) }}">
                                         </td>
                                         <td>{{$product['product_code']}} </td>
                                        <td>{{$product['product_name']}} </td>
                                        <td> {{$product['product_size']}} </td>
                                        <td> {{$product['product_color']}} </td>
                                        <td> {{$product['product_qty']}} </td>
                                        
                        </tr>

                        @endforeach
                    </table>        
                </div >
                <div class="card">
                <div class="card-header">
                <h3 class="card-title"> Update Order Status  </h3>
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                    <td colspan="2">
                                    <form action="{{url('admin/update-order-status')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $orderDetails['id'] }}">
                                    <select class="form-select" aria-label="Default select example" name="order_status" 
                                    id="order_status" required="">
                                    <option>Select Status</option>
                                    @foreach($orderStatus as $status)
                                    <option vale="{{$status ['name']}}" @if(isset($orderDetails['order_status']) &&
                                     $orderDetails['order_status'] == $status ['name']) selected="" @endif>{{$status ['name']}}</option>
                                    @endforeach
                                    </select>&nbsp;&nbsp;
                                    <input style="width:120px;" type="test" name="courier_name" @if(empty($orderDetails['courier_name']))
                                     id="courier_name" @endif placeholder="courier name" value="{{$orderDetails['courier_name']}}">
                                    <input style="width:120px;" type="test" name="tracking_number"@if(empty($orderDetails['tracking_number']))
                                     id="tracking_number" @endif placeholder="tracking number" value="{{$orderDetails['tracking_number']}}">
                                    <button type="submit" class="btn btn-primary" > Update </button>
                                    </td>
                                </tr>
                                <tr>
                                <td colspan="2">
                                    @foreach ($orderLog as $log)
                                        <strong>{{ $log['order_status'] }} </strong><br>
                                        {{ date('j F , Y, g:i a', strtotime($log['created_at'])) }} <hr>
                                    @endforeach
                                </td>
                                </tr>
                                </tbody>
                               
				</table>
                </div>
                </div>
                
		
            

	</div>
	
@endsection
@section('js')

@endsection
@section('css')

@endsection
