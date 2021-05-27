<?php  use App\models\Product; ?>
@extends('layouts.Client_layout.Client_layout')
@section ('content')
<!-- Register Section Begin -->

<div style="margin:auto; display:block;">
<ul class="breadcrumb">
    <li><a href="{{ url('/index') }}"> Home </a> <span class="divider">/</span></li>
    <li class="active"><a href="{{ url('/orders') }}"> Orders </a></li>
</ul>
                        <h2>Orders #{{ $orderDetails['id'] }} Details</h2>
                     <div class="">
                         <div class="span4">
                              <table class="table table-striped table-bordered">
                                <tr>
                                    <td colspan="2"><strong>Order Details</strong></td>
                                </tr>
                        </table>
                    </div>
                <div class="">
                         <div class="span4">
                              <table class="table table-striped table-bordered">
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

                            </table>
                        </div> 
                        <table class="table table-striped table-bordered">
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


                        <div class="">
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
                                        <a  target="_blank" href="{{ url('product/'.$product['product_id']) }}" > <img style="width: 80px; " src="{{ asset('images/product_images/small/'.$getProductImage) }}">
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

              
                        
                 
                   
        </div>
</div>
    
    <!-- Register Form Section End -->


@endsection