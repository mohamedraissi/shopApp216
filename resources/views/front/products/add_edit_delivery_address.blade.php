@extends('layouts.Client_layout.Client_layout')
@section ('content')
<!-- Register Section Begin -->
<div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                @if(Session::has('success_message'))
					   <div class="alert alert-success" role="alert" style="margin-top:10px;">
				  	   {{ Session::get('success_message')}}
						   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						 	   <span aria-hidden="true">&times;</span>
						   </button>
				  	 </div>
                       <?php Session::forget('success_message'); ?>
	      	 @endif
                @if(Session::has('error_message'))
					   <div class="alert alert-danger" role="alert" style="margin-top:10px;">
				       	{{ Session::get('error_message')}}
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						     	<span aria-hidden="true">&times;</span>
						   </button>
				    	</div>
                        <?php Session::forget('error_message'); ?>
	      	 @endif
               @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                       @foreach ($errors->all() as $error)
                                                         <li>{{ $error }}</li>
                                                       @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                    <div class="register-form">

                        <h2>{{ $title }}</h2>
                        
                        <form id="deliveryAddressForm" @if(empty($address['id'])) action="{{url ('/add-edit-delivery-address') }}"
                        @else action="{{url ('/add-edit-delivery-address/'.$address['id']) }}" @endif method="post">
                        @csrf
                        <div class="group-input">
                                <label for="name">Name *</label>
                                <input type="text" placeholder="Enter Name" id="name" name="name" @if (isset($address['name']))
                                value="{{ $address['name'] }} @else value="{{ old('name') }}" @endif" >
                                <div class="group-input"  required="">
                            <div class="group-input">
                                <label for="address">address *</label>
                                <input type="text" placeholder="Enter Address" id="address" name="address" @if (isset($address['address']))
                                value="{{ $address['address'] }} @else value="{{ old('address') }}" @endif" >
                            </div>
                                <div class="group-input">
                                <label for="city">City *</label>
                                <input type="text" placeholder="Enter City" id="city" name="city" @if (isset($address['city']))
                                value="{{ $address['city'] }} @else value="{{ old('city') }}" @endif" >
                            </div>
                            </div>
                            <div class="group-input">
                                <label for="state">State *</label>
                                <input type="text" placeholder="Enter State" id="state" name="state" @if (isset($address['state']))
                                value="{{ $address['state'] }} @else value="{{ old('state') }}" @endif">
                            </div>
                            <div class="group-input">
                                <label for="country" >Country *</label>
                                <select class="span3" id="country" name="country">
                                    <option  placeholder="Select Country"></option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['country_name'] }}" @if($country['country_name']==$address['country']) 
                                        selected="" @endif>{{ $country['country_name'] }} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="group-input">
                                <label for="mobile">Mobile *</label>
                                <input type="text" placeholder="Enter mobile" id="mobile" name="mobile"  @if (isset($address['mobile']))
                                value="{{ $address['mobile'] }} @else value="{{ old('mobile') }}" @endif"">
                            </div>
                            <div class="group-input">
                                <label for="pincode">pincode *</label>
                                <input type="text" placeholder="Enter pincode" id="pincode" name="pincode"  @if (isset($address['pincode']))
                                value="{{ $address['pincode'] }} @else value="{{ old('pincode') }}" @endif">
                            </div>
                            
                            <button type="submit" class="site-btn register-btn">Submit</button>
                            <br>
                            <br>
                            <a style="float:right; text-align:center"class="site-btn register-btn" href="{{url('checkout')}}">Back</a>
                        </form>
                        <div class="register-login-section spad">
            
                </div>
            </div>
        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Register Form Section End -->


@endsection