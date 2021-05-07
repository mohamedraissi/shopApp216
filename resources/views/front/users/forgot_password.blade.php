@extends('layouts.Client_layout.Client_layout')
@section ('content')

    <!-- Breadcrumb Section Begin -->

                </div>
            </div>
        </div>
    </div>
     <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

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
                    <div class="login-form">
                        <h2>FORGOT PASSWORD</h2>
                        <form id="loginForm" action="{{ url('/forgot_password') }}" method="post">
                        @csrf
                        <div class="group-input">
                                <label for="Email">Enter your email to get new password</label>
                                <input type="text" placeholder="Enter Email" id="email" name="email">
                        </div>
                            </div>
                            <button type="submit" class="site-btn ">Submit</button>
                        </form>
                        <div class="switch-login">
                            <a href="./register.html" class="or-login">Or Create An Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection