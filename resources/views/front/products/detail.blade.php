@extends('layouts.Client_layout.Client_layout')

@section('content')
  <!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="{{url('/index') }}"><i class="fa fa-home"></i> Home</a>
                    <a href="{{url('/'.$productDetails['category']['url']) }}">{{ $productDetails['category']['category_name'] }}
                    </a>
                    <span>{{ $productDetails['product_name'] }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="product-details">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6 py-3 order-2 order-lg-1">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" ></li>
              @foreach($productDetails['images'] as $key=>$image)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$key+1}}" ></li>
              @endforeach
               
              </ol>
              <div class="carousel-inner">
              <div class="carousel-item  active ">
              <div style="width:100%;height:627px;background:url({{ asset('images/product_images/large/'.$productDetails['main_image']) }});background-size: cover;background-position: center center;">
                
              </div>
              </div>
              @foreach($productDetails['images'] as $key=>$image)
                <div class="carousel-item ">
                <div style="width:100%;height:627px;background:url({{ asset('images/product_images/large/'.$image['image']) }});background-size: cover;background-position: center center;">
                
                </div>
                 
                </div>
                @endforeach
               
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>  
          </div>
          <div class="d-flex align-items-center col-lg-6 col-xl-5 pl-lg-5 mb-5 order-1 order-lg-2">
            <div>
              <ul class="breadcrumb justify-content-start">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url($productDetails['category']['url'])}}">{{ $productDetails['category']['category_name']}}</a></li>
              </ul>
              <h1 class="mb-4">{{ $productDetails['product_name'] }}</h1>
              <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                <ul class="list-inline mb-2 mb-sm-0 getAttrPrice" >
                  <li class="list-inline-item h4 font-weight-light mb-0">{{ $productDetails['product_price'] }}dt</li>
                  
                </ul>
                <div class="d-flex align-items-center">
                  <ul class="list-inline mr-2 mb-0">
                    <li class="list-inline-item mr-0"><i class="fa fa-cubes text-primary"></i></li>
                    
                  </ul><span class="text-muted text-uppercase text-sm">{{ $total_stock }} items in stock</span>
                </div>
              </div>
              <p class="mb-4 text-muted">{{ $productDetails['product_description'] }}</p>
              <form action="{{ url('add-to-cart') }}" method="post" class="d-flex justify-content-left">@csrf
               <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
                <div class="row">
                  <div class="col-sm-6 col-lg-12 detail-option mb-3">
                    <h6 class="detail-option-heading">Brand </h6>
                    <label class="btn btn-sm btn-outline-secondary detail-option-btn-label" for="size_0"> {{ $productDetails['brand']['name'] }}
                      <input class="input-invisible" type="radio" name="size" value="value_0" id="size_0" >
                    </label>
                    
                  </div>
                  <div class="col-sm-6 col-lg-12 detail-option mb-3">
                    <h6 class="detail-option-heading">{{$productDetails['attributes'][0]['type_name'] }} <span>(required)</span></h6>
                    <select class="form-control" name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" required="" >
                       <option value=""> Select {{$productDetails['attributes'][0]['type_name'] }}</option>
                       @foreach($productDetails['attributes'] as $attribute)
                       <option value="{{ $attribute['size'] }}"> {{ $attribute['size'] }} </option>
                       @endforeach
                     </select>
                  </div>
                  <div class="col-12 detail-option mb-3">
                    <h6 class="detail-option-heading">Colour </h6>
                    <ul class="list-inline mb-0 colours-wrapper">
                      <li class="list-inline-item">
                        <label class="btn-colour" for="colour_Blue" style="background-color: {{$productDetails['product_color']}}"> </label>
                        <input class="input-invisible" type="radio" name="colour" value="value_Blue" id="colour_Blue" >
                      </li>
                     
                    </ul>
                  </div>
                  <div class="col-12 col-lg-6 detail-option mb-5">
                    <label class="detail-option-heading font-weight-bold">Items <span>(required)</span></label>
                    <input class="form-control detail-quantity" name="quantity" type="number" value="1"  required="" >
                  </div>
                  <div class="col-12 col-lg-6 detail-option mb-5">
                  <button class="btn btn-dark btn-lg mb-1" type="submit"> <i class="fa fa-shopping-cart mr-2"></i>Add to Cart</button>
                  </div>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="mt-5">
      <div class="container">
        <ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
          <li class="nav-item"><a class="nav-link detail-nav-link active" data-toggle="tab" href="#description" role="tab">Description</a></li>
          <li class="nav-item"><a class="nav-link detail-nav-link" data-toggle="tab" href="#additional-information" role="tab">Additional Information</a></li>
          
        </ul>
        <div class="tab-content py-4">
          <div class="tab-pane active px-3" id="description" role="tabpanel">
            <p class="text-muted">{{ $productDetails['product_description'] }}</p>
          </div>
          <div class="tab-pane" id="additional-information" role="tabpanel">
            <div class="row">
              <div class="col-lg-12">
              <table >
                  <tbody>
                   <tr ><th >Product Details</th></tr>
                   <tr ><td >Brand:</td><td>{{ $productDetails['brand']['name'] }}</td></tr>
                   <tr ><td>Code:</td><td >{{ $productDetails['product_code']}}</td></tr>
                 </tbody>
               </table>   
              </div>
             
            </div>
          </div>
         
        </div>
      </div>
    </section>


@endsection