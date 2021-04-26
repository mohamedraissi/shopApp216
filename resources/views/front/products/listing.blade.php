<?php   
 use App\Models\Section;
$sections = Section::sections();

?>


@extends('layouts.Client_layout.Client_layout')

@section('content')



<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{url('/')}}"><i class="fa fa-home"></i> home</a>
                    <span> {{$categoryDetails['categoryDetails']['category_name']}} </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
             @include('layouts.client_layout.front_sidebar')    
            <div class="col-lg-9 order-1 order-lg-2">
                <h3 class='mb-3'> {{$categoryDetails['categoryDetails']['category_name']}}</h3>
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <form name="sortProducts" id="sortProducts">
                                <input type="hidden" name="url" id="url" value='{{$url}}'>
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <div class="select-option">
                                    <select name="sort" id='sort' class="sorting">
                                        <option value="">Default Sorting</option>
                                        <option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort']=="product_latest") selected="" @endif>Product latest</option>
                                        <option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_a_z") selected="" @endif>Product name A-Z</option>
                                        <option value="product_name_z_a" @if(isset($_GET['sort']) && $_GET['sort']=="product_name_z_a") selected="" @endif>Product name Z-A</option>
                                        <option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort']=="price_lowest") selected="" @endif>Product lowest first</option>
                                        <option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort']=="price_highest") selected="" @endif>Product highest first</option>
                                    </select>
                                    <select class="p-show">
                                        <option value="">Show:</option>
                                    </select>
                                </div>
                            </form>
                            
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                        <small class="pull-right">{{count($categoryProducts)}} product aret avaible</small>
                        </div>
                    </div> 
                </div>
                <div class="product-list">
                     @include('front.products.ajax_products_listing')
                </div>
                <div class="loading-more pagination">
                @if(isset($_GET['sort']) && !empty($_GET['sort'])) 
                {{ $categoryProducts->appends(['sort' => $_GET['sort']])->links() }}
                @else
                {{ $categoryProducts->links() }}
                
                @endif   

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src={{ asset("front/img/logo-carousel/logo-1.png") }} alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src={{ asset("front/img/logo-carousel/logo-2.png") }} alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src={{ asset("front/img/logo-carousel/logo-3.png") }} alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src={{ asset("front/img/logo-carousel/logo-4.png") }} alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src={{ asset("front/img/logo-carousel/logo-5.png") }} alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partner Logo Section End -->
@endsection
