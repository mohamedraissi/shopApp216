<?php use App\Models\Product; ?>
<table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Description</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Quantity</th>
                                    <th>Discounted Price</th>
                                    
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
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
                                        <div class="quantity" >
                                            <input class="span1" style="max-width:34px" size="16" type="text" value="{{ $item['quantity'] }}">
                                            <button class="btn qtybtn dec" type="button" data-cartid="{{$item['id']}}">-<i class="icon-minus"></i></button>

                                            <button class="btn qtybtn inc" type="button" data-cartid="{{$item['id']}}">+<i class="icon-plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="price first-row" style="color:green">{{ $attrPrice['discounted_price']}}</td>
                                    <td class="close-td first-row btnItemDelete" data-cartid="{{$item['id']}}" type="button"><i class="ti-close"></i></td>
                                </tr>
                                <?php $total_price = $total_price +   ($attrPrice['discounted_price'] * $item['quantity']); ?>
                                @endforeach
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
                               
                            </tbody>
                        </table>