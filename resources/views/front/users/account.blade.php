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
	      	 @endif
                @if(Session::has('error_message'))
					   <div class="alert alert-danger" role="alert" style="margin-top:10px;">
				       	{{ Session::get('error_message')}}
						    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						     	<span aria-hidden="true">&times;</span>
						   </button>
				    	</div>
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

                        <h2>Contact details</h2>
                        
                        <form id="accountForm" action="{{url ('/account') }}" method="post">
                        @csrf
                        <div class="group-input">
                                <label for="name">Name *</label>
                                <input type="text" placeholder="Enter Name" id="name" name="name" value="{{ $userDetails['name'] }}">
                                <div class="group-input" >
                            <div class="group-input">
                                <label for="address">address *</label>
                                <input type="text" placeholder="Enter Address" id="address" name="address" value="{{ $userDetails['address'] }}">
                            </div>
                                <div class="group-input">
                                <label for="city">City *</label>
                                <input type="text" placeholder="Enter City" id="city" name="city" value="{{ $userDetails['city'] }}">
                            </div>
                            </div>
                            <div class="group-input">
                                <label for="state">State *</label>
                                <input type="text" placeholder="Enter State" id="state" name="state" value="{{ $userDetails['state'] }}">
                            </div>
                            <div class="group-input">
                                <label for="country" >Country *</label>
                                <select name="country" id="country">
                                    <option  value="Select Country"></option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['country_name'] }}" @if( $country['country_name'] == $userDetails ['country']) selected="" @endif)>{{ $country['country_name'] }} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="group-input">
                                <label for="mobile">Mobile *</label>
                                <input type="text" placeholder="Enter mobile" id="mobile" name="mobile" value="{{ $userDetails['mobile'] }}">
                            </div>
                            <div class="group-input">
                                <label for="Country">pincode *</label>
                                <input type="text" placeholder="Enter pincode" id="pincode" name="pincode" value="{{ $userDetails['pincode'] }}">
                            </div>
                            <div class="group-input">
                                <label for="Email">Email address *</label>
                                <input type="text" readonly="" id="email" name="email" value="{{ $userDetails['email'] }}">
                            </div>
                            <button type="submit" class="site-btn register-btn">UPDATE</button>
                        </form>
                        <div class="register-login-section spad">
                    <div class="update-form">
                        <h2>Update password</h2>
                        <form id="passwordForm" action="{{ url('/update-user-pwd') }}" method="post">
                        @csrf
                            <div class="control-group">
                                <label for="current_pwd">Current Password *</label>
                                <input type="password" placeholder="Current Password" id="current_pwd" name="current_pwd">
                               <span id="chkpassword"><br></span>
                            </div>
                            <div class="group-input">
                                <label for="new_pwd">New Password *</label>
                                <input type="password" placeholder="Enter new Password" id="new_pwd" name="new_pwd">
                            </div>
                            <div class="group-input">
                                <label for="confirm_pwd">Confirm Password *</label>
                                <input type="password" placeholder="Confirm new Password" id="confirm_pwd" name="confirm_pwd">
                            </div>
                            <div class="group-input gi-check">
                                <div class="gi-more">
                            </div>
                            <button type="submit" class="site-btn login-btn">UPDATE PASSWORD</button>
                            
                        </form>
                    </div>
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