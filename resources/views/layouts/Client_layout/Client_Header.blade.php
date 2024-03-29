
  <?php
use App\Models\Product; 
use App\Models\Section;
use App\Models\Cart;
$userCartItems = Cart::userCartItems();
$sections =Section::sections();
  
  ?>
  <header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="ht-left">
                <div class="mail-service">
                    <i class=" fa fa-envelope"></i>
                    fashi@gmail.com
                </div>
                <div class="phone-service">
                    <i class=" fa fa-phone"></i>
                    +65 11.188.888
                </div>
            </div>
            <div class="ht-right">
            @if(Auth::check())
                
                <a href="{{ url('account') }}" class="login-panel"><i class="fa fa-user"></i>My Account</a>
                <a href="{{ url('logout') }}" class="login-panel" style="margin-left: auto; margin-right: auto;"><i class="fa fa-user"></i>Logout</a>
                <a href="{{ url('orders') }}" class="login-panel" style="margin-left: auto; margin-right: auto;"><i class="fa fa-user"></i>Orders</a>
                @else
                <a href="{{ url('Login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
                <a href="{{ url('Register') }}" class="login-panel"><i class="fa fa-user"></i>Register</a>
                @endif
               
                <div class="top-social">
                    <a href="#"><i class="ti-facebook"></i></a>
                    <a href="#"><i class="ti-twitter-alt"></i></a>
                    <a href="#"><i class="ti-linkedin"></i></a>
                    <a href="#"><i class="ti-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="/">
                            <img src={{ asset("front/img/logo.png" ) }}>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="advanced-search">
                        <button type="button" class="category-btn">All Categories</button>
                        <div class="input-group">
                            <input type="text" placeholder="What do you need?">
                            <button type="button"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 text-right col-md-3">
                    <ul class="nav-right">
                       
                        <li class="cart-icon">
                            <a href="{{ url('cart') }}">
                                <i class="icon_bag_alt"></i>
                                <span class="totalCartItems">{{totalCartItems()}}</span>
                            </a>
                            
                            <div class="cart-hover">
                                <div class="select-items">
                                    <table>
                                        <tbody>
                                        <?php $total_price = 0; ?>
                                        @foreach($userCartItems as $item)
                                        <?php $attrPrice = Product::getDiscountedAttrPrice($item['product_id'],$item['size']); ?>
                                            <tr>
                                                <td class="si-pic"><img src="{{ asset('images/product_images/small/'.$item['product']['main_image']) }}" alt=""></td>
                                                <td class="si-text">
                                                    <div class="product-selected">
                                                        <p>{{ $attrPrice['product_price']}} dt</p>
                                                        
                                                        <h6>{{ $item['product']['product_name'] }}</h6>
                                                    </div>
                                                </td>
                                                <td class="si-close">
                                                    <i class="ti-close"></i>
                                                </td>
                                            </tr>
                                            <?php $total_price = $total_price +   ($attrPrice['discounted_price'] * $item['quantity']); ?>
                                        @endforeach    
                                        </tbody>
                                    </table>
                                </div>
                                <div class="select-total">
                                    <span>total:</span>
                                    <h5> {{ $total_price }} dt</h5>
                                </div>
                                <div class="select-button">
                                    <a href="/cart" class="primary-btn view-card">VIEW CARD</a>
                                    <a href="/checkout" class="primary-btn checkout-btn">CHECK OUT</a>
                                </div>
                            </div>
                        </li>
                        <li class="cart-price">{{ $total_price }} dt</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-item">
        <div class="container">
           
           
            <nav class="nav-menu mobile-menu">
                <ul>
                    <li class="active"><a href="/index">Home</a></li>
                    
                    @foreach($sections as $section)
                    <li><a href="#">{{$section['name']}}</a>
                        <ul class="dropdown">
                            @foreach($section['categories'] as $category)
                                <li><a href="{{url($category['url'])}}">{{$category['category_name']}}</a></li>
                                    @foreach($category['subcategories'] as $subcategory)
                                    <li><a href="{{url($subcategory['url'])}}" class="font-weight-normal pt-0 pl-5">{{$subcategory['category_name']}}</a></li>
                                    @endforeach
                                    @if(count($section['categories'])>1)
                                        <hr class="mt-0"  style="border-top: 1px solid rgb(255 255 255 / 10%);margin-left:20px;margin-right:20px;"> 
                                    @endif
                            @endforeach        
                        </ul>
                    </li>
                    @endforeach
                    <li><a href="/contact">Contact</a></li>
                  
                </ul>
            </nav>
            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>