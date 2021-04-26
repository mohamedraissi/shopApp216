<?php use App\Models\Cart; ?>
@extends('layouts.Client_layout.Client_layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>
                                @foreach($userCartItems as $item)
                                <?php $attrPrice = Cart::getProductAttrPrice($item['product_id'],$item['size']); ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5> {{ $item['product']['product_name'] }}</h5></br>
                                       
                                    </td>
                                    
                                    <td>
                                         Size : {{ $item['size'] }}</br>
                                        code : {{ $item['product']['product_code'] }}</br>
                                    </td>
                                    <td class="p-price first-row">{{ $attrPrice}}</td>
                                    <td class="qua-col first-row">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{ $item['quantity'] }}">
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="total-price first-row">{{ $attrPrice * $item['quantity'] }}</td>
                                    <td class="close-td first-row"><i class="ti-close"></i></td>
                                </tr>
                                <?php $total_price = $total_price + ($attrPrice * $item['quantity']); ?>
                                @endforeach

                               
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <a href="#" class="primary-btn up-cart">Update cart</a>
                            </div>
                            <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Subtotal <span>{{ $total_price }}</span></li>
                                    <li class="cart-total">Total <span>{{ $total_price }}</span></li>
                                </ul>
                                <a href="#" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->






@endsection