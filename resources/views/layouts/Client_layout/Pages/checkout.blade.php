<?php use App\Models\Product; ?>
@extends('layouts.Client_layout.Client_layout')

@section('content')
@if(Session::has('success_message'))
					   <div class="alert alert-success container" role="alert" style="margin-top:10px;">
				  	   {{ Session::get('success_message')}}
						   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 	   <span aria-hidden="true">&times;</span>
						   </button>
				  	 </div>
                       <?php Session::forget('success_message'); ?> 
	      	 @endif
                @if(Session::has('error_message'))
					   <div class="alert alert-danger container" role="alert" style="margin-top:10px;">
				       	{{ Session::get('error_message')}}
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						     	<span aria-hidden="true">&times;</span>
						   </button>
				    	</div>
                        <?php Session::forget('error_message'); ?>
	      	 @endif
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->
<section class="checkout-section spad">
        <div class="container">
            <form name="checkoutform" id="checkoutform" action="{{ url('checkout') }}" method="post" class="checkout-form">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href=" @if(Auth::user()) # @else {{ url('Login')}} @endif" class="content-btn @if(Auth::user())disabled @endif">Click Here To Login</a>
                        </div>
                        <h4>Biiling Details</h4>
                        <div class="row">
                        @if(!empty($deliveryAddresses))
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">name </th>
                                    <th scope="col">Country </th>
                                    <th scope="col">address </th>
                                    <th scope="col">phone </th>
                                    <th scope="col">Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($deliveryAddresses as $address)
                           
                            
                                    <tr>
                                    <th scope="row"><input type="radio" id="address {{$address['id']}}" name="address_id" value="{{$address['id']}}"></th>
                                    <td>{{$address['name']}}</td>
                                    <td>{{$address['country']}}</td>
                                    <td>{{$address['address']}}</td>
                                    <td>{{$address['mobile']}}</td>
                                    <td>
                                        <a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}">Edit</a> | 
                                        <a href="{{ url('delete-edit-delivery-address/'.$address['id']) }}" class="addressDelete">Delete</a>
                                    </td>
                                    </tr>
                                
                            
                    @endforeach
                        </tbody>
                    </table>
                    @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="checkout-content">
                            <a href=" @if(!Auth::user()) # @else {{url('add-edit-delivery-address')}} @endif"  class="content-btn @if(!Auth::user())disabled @endif" > Add Address </a>
                        </div>
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                               
                                    <li>Product <span>Total</span></li>
                                    <?php $total_price = 0; ?>
                                    @foreach($userCartItems as $item)
                                        <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
                                        <li class="fw-normal">
                                        <img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" style="width:25px" alt="">
                                         {{$item['product']['product_name']}} x {{$item['quantity']}} <span>{{ $attrPrice['product_price']}} DT</span>
                                        </li>
                                        <?php $total_price = $total_price +   ($attrPrice['discounted_price'] * $item['quantity']); ?>
                                    @endforeach
                                    <li class="fw-normal"> Coupon Discount: <span>
                                    @if(Session::has('CouponAmount'))
                                        $ {{ Session::get('CouponAmount') }}
                                   @else
                                        $ 0
                                    @endif
                                    </span></li>
                                    <li class="fw-normal">Subtotal <span>( ${{ $total_price }} - @if(Session::has('CouponAmount'))
                                        $ {{ Session::get('CouponAmount') }} )
                                   @else
                                        $ 0 )
                                    @endif</span></li>
                                    
                                    <li class="total-price">Total <span>{{ $total_price - Session::get('CouponAmount')}}</span></li>
                                    <li class="total-price">Grand Total <span>{{ $grand_total = $total_price - Session::get('CouponAmount')}}
                                        <?php Session::put('grand_total',$grand_total); ?></span></li>
                                </ul>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="COD">
                                            Cheque Payment
                                            <input type="checkbox" name="payment_gateway" id="COD"  value="COD">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="paypal">
                                            Paypal
                                            <input type="checkbox"  name="payment_gateway" id="paypal" value="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="order-btn">
                                    <button type="submit" class="site-btn place-btn">Place Order</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form name="checkoutform" id="checkoutform" action="{{ url('checkout') }}" method="post" class="">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <a href="{{ url('Login')}}" class="content-btn">Click Here To Login</a>
                        <br>
                        <a href="{{url('add-edit-delivery-address')}}"  class="content-btn" > Add Address </a>
                    </div>
                    
                    <div class="place-order">
                            <h4>Your Order</h4>
                            @if(!empty($deliveryAddresses))
                            @foreach ($deliveryAddresses as $address)
                            <div class="order-total">
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                        {{$address['name']}} , {{$address['address']}} , {{$address['city']}}-{{$address['pincode']}}
                        ,{{$address['country']}} , {{$address['state']}} , <span style="float:right;">(Phone:{{$address['mobile']}} )
                                            <input type="radio" id="address {{$address['id']}}" name="address_id" value="{{$address['id']}}">
                                            <span class="checkmark"> </span>
                                        </label>
                                        <a href="{{ url('/add-edit-delivery-address/'.$address['id']) }}">Edit</a> | 
                                        <a href="{{ url('delete-edit-delivery-address/'.$address['id']) }}" class="addressDelete">Delete</a>
                                    </div>
                                    
                                </div>
</div>
                    @endforeach
                    @endif
                   <br> 
            </table>
            <table class="table table-bordered">
                                <?php $total_price = 0; ?>
                                @foreach($userCartItems as $item)
                                <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5> {{ $item['product']['product_name'] }}</h5></br>
                                       
                                    </td>
                                    
                                    <td>
                                         Size : {{ $item['size'] }}</br>
                                        code : {{ $item['product']['product_code'] }}</br>
                                    </td>
                                    <td class="p-price first-row">{{ $attrPrice['product_price']}}</td>
                                    <td class="p-price first-row">{{ $attrPrice['discount']}}</td>
                                    <td class="qua-col first-row">
                                        {{$item['quantity']}}
                                    </td>
                                    
                                    <td class="price first-row" style="color:green">{{ $attrPrice['discounted_price']}}</td>
                                </tr>
                                <?php $total_price = $total_price +   ($attrPrice['discounted_price'] * $item['quantity']); ?>
                                @endforeach
                                
                            </table>
                           
                                <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <li class="fw-normal">Coupon Discount: <span>@if(Session::has('CouponAmount'))
                                        $ {{ Session::get('CouponAmount') }}
                                   @else
                                        $ 0
                                    @endif</span></li>
                                    <li class="fw-normal">Subtotal <span>( ${{ $total_price }} - <span>@if(Session::has('CouponAmount'))
                                        $ {{ Session::get('CouponAmount') }} )
                                   @else
                                        $ 0 )
                                    @endif</span></li>
                                    <li class="total-price">Total <span>{{ $total_price - Session::get('CouponAmount')}}</span></li>
                                    <li class="total-price">Grand Total <span>{{ $grand_total = $total_price - Session::get('CouponAmount')}}
                                        <?php Session::put('grand_total',$grand_total); ?>
                                    </span></li>
                                </ul>
                    
                                <strong> PAYMENT METHODS: </strong>
                                <div class="payment-check">
                                    <div class="pc-item">
                                        <label for="pc-check">
                                            Cheque Payment
                                            <input type="radio" name="payment_gateway" id="COD"  value="COD">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="pc-item">
                                        <label for="pc-paypal">
                                            Paypal
                                            <input type="radio" name="payment_gateway" id="paypal" value="paypal">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                    <br>
                    <br> 
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Place Order</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->


@endsection