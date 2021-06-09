@extends('layouts.Client_layout.Client_layout')

@section('content')


<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      

      <!-- Collapse -->
     
      <!-- Links -->
     
        <!-- Left -->
        

        <!-- Right -->
       

      </div>

    </div>
  </nav>
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
<!-- Breadcrumb Section Begin -->
  <!-- Navbar -->

  <!--Main layout-->
  <main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

      <!--Grid row-->
      <div class="row wow fadeIn">
        
       

        <!--Grid column-->

        <div class="col-md-6 mb-4" id="gallery">
           <a href="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" >

              <img src="{{ asset('images/product_images/large/'.$productDetails['main_image']) }}" class="img-fluid" alt="">
          </a>    

        </div>
        
        <!--Grid column-->


        <!--Grid column-->
        <div class="col-md-6 mb-4">

          <!--Content-->
          <div class="p-4">

           @if(Session::has('success_message'))
					   <div class="alert alert-success" role="alert" style="margin-top:10px;">
				  	   {{ Session::get('success_message')}}
						   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 	   <span aria-hidden="true">&times;</span>
						   </button>
				  	 </div>
	      	 @endif
           @if(Session::has('error_message'))
					   <div class="alert alert-danger" role="alert" style="margin-top:10px;">
				       	{{ Session::get('error_message')}}
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						     	<span aria-hidden="true">&times;</span>
						   </button>
				    	</div>
	      	 @endif

            <div class="mb-3">
              <h3>{{ $productDetails['product_name'] }}</h3>
              <small>{{ $productDetails['brand']['name'] }}</small>
              
            </div>

            <!-- <p class="lead"> -->
              <!-- <span class="mr-1">
                <del>$200</del>
              </span> -->
              <!-- <span class="getAttrPrice">{{ $productDetails['product_price'] }}</span> </br>
              <small>{{ $total_stock }} items in stock</small>
            </p> -->

            <p class="lead font-weight-bold">Description</p>

            <p>{{ $productDetails['product_description'] }}</p>

           <!-- <form class="d-flex justify-content-left"> -->
              <!-- Default input -->
              <!-- <input type="number" value="1" aria-label="Search" class="form-control" style="width: 100px">
              
             <div class="mt-1">
                  
                  <select class="span2 pull-left" name="size" id="getPrice" product-id="{{ $productDetails['id'] }}">
                     <option> Select Size </option>
                     @foreach($productDetails['attributes'] as $attribute)
                     <option> {{ $attribute['size'] }} </option>
                     @endforeach
                   </select>
                  
                </div>
                <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                <i class="fas fa-shopping-cart ml-1"></i>
              </button>

            </form> -->
            <small>{{ $total_stock }} items in stock</small>
            <form action="{{ url('add-to-cart') }}" method="post" class="d-flex justify-content-left">@csrf
               <input type="hidden" name="product_id" value="{{ $productDetails['id'] }}">
               <div>
                 <div class="mt-1">
                   <h4 class="getAttrPrice">{{ $productDetails['product_price'] }}$</h4>
                     
                     <select class="span2 pull-left" name="size" id="getPrice" product-id="{{ $productDetails['id'] }}" required="" >
                       <option value=""> Select {{$productDetails['attributes'][0]['type_name'] }}</option>
                       @foreach($productDetails['attributes'] as $attribute)
                       <option value="{{ $attribute['size'] }}"> {{ $attribute['size'] }} </option>
                       @endforeach
                     </select><input name="quantity" type="number" value="1" aria-label="Search" class="form-control" style="width: 100px" required="">
                     
                     <button class="btn btn-primary btn-md my-0 p" type="submit">Add to cart
                     <i class="fas fa-shopping-cart ml-1"></i>
                     </button>
                  </div>
                </div>
             </form>
            
            

          </div>
          <!--Content-->
          

        </div>
        <!--Grid column-->
        <div class="row">
            <div class="col-3">
              <div class="view overlay rounded z-depth-1 gallery-item">
                @foreach($productDetails['images'] as $image)
                  <a href="{{ asset('images/product_images/large/'.$image['image']) }}">
                  <img src="{{ asset('images/product_images/large/'.$image['image']) }}"
                  class="img-fluid"> </a>
                  <div class="mask rgba-white-slight"></div>
                @endforeach
              </div>
            </div> 
         </div>  
        <div >
              <div >
                <h4>Product information</h4>
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
      <!--Grid row-->

      <hr>

      <!--Grid row-->
      <div class="row d-flex justify-content-center wow fadeIn">

        <!--Grid column-->
        <div class="col-md-6 text-center">

          <h4 class="my-4 h4">Additional information</h4>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
            voluptates,
            quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

      <!--Grid row-->
      <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/12.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-4">

          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/13.jpg" class="img-fluid" alt="">

        </div>
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <!--Main layout-->

  

@endsection