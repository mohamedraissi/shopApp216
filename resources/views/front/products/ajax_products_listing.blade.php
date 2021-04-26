
                    <div class="row">
                        @foreach($categoryProducts as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <!--<img src={{ asset("front/img/products/product-1.jpg") }} alt="">-->
                                        <?php $product_image_path =  'images/products_images/small/' .$product['main_image'];?>
                                        @if(!empty($product['main_image']) &&file_exists($product_image_path))
                                        <img style="width: 250px; height:250px;" src="{{asset($product_image_path)}}" alt="">
                                        @else<img style="width: 250px; height:250px;" src ="{{asset('images/product_images/small/'.$product['main_image'])}}" alt="">
                                        @endif

                                        <div class="sale pp-sale">Sale</div>
                                        <div class="icon">
                                            <i class="icon_heart_alt"></i>
                                        </div>
                                        <ul>
                                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                                            <li class="quick-view"><a href="#">+ Quick View</a></li>
                                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name">{{$product['brand']['name']}}</div>
                                        <a href="#">
                                            <h5>{{$product['product_name']}}</h5>
                                        </a>
                                        <div class="product-price">
                                            {{$product['product_price']}}$
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

