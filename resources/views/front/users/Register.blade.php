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
                    <div class="register-form">
                        <h2>Register</h2>
                        <form id="registerForm" action="{{url ('/Registered') }}" method="post">
                        @csrf
                        <div class="group-input">
                                <label for="name">Name *</label>
                                <input type="text" placeholder="Enter Name" id="name" name="name">
                                <div class="group-input">
                            <div class="group-input">
                                <label for="Email">Email address *</label>
                                <input type="text" placeholder="Enter Email" id="email" name="email">
                            </div>
                                <div class="group-input">
                                <label for="Mobile">Mobile *</label>
                                <input type="text" placeholder="Enter Mobile" id="mobile" name="mobile">
                            </div>
                            </div>
                            <div class="group-input">
                                <label for="password">Password *</label>
                                <input type="password" placeholder="Password" id="password" name="password">
                            </div>
                            <div class="group-input">
                                <label for="confirm_password">Confirm Password *</label>
                                <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                            </div>
                            <button type="submit" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="./login.html" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->


@endsection