@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20">
			
			
			<!-- Default Basic Forms Start -->
            <div class="card-box mb-30">
               <h2 class="h4 pd-20">Settings</h2>
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							
                        <h4 class="text-blue h4">update password</h4></br>
						</div>
						
					</div>
					<form role="form" methode="post" action="{{ url('/admin/update-pwd') }}" name="updatePasswordForm" 
                    id ="updatePasswordForm"> @csrf
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Admin name</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  value="{{ $adminDetails->name}}" placeholder="Enter admin or subadmin name"
                                 id="admin_name" name="admin_name">
                                
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Admin Email</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  value="{{ $adminDetails->email}}" readonly="">
							</div>
						</div>

                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Admin type</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  value="{{ $adminDetails->type}}" readonly="">
							</div>
						</div>
						
						
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Current Password</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  type="password" name="current_pwd" id="current_pwd" placeholder="Enter current password">
								<span id="chkCurrentPassword"></span>
							</div>
						</div>

                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">New Password</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  type="password" name="new_pwd" id="new_pwd" placeholder="Enter new password">
							</div>
						</div>

                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">confirm Password</label>
							<div class="col-sm-12 col-md-10">
								<input class="form-control"  type="password" name="confirm_pwd" id="confirm_pwd" placeholder="confirm new password">
							</div>
						</div>
                        <!-- <div class="pull-right">
							<a href="#basic-form1" class="btn btn-primary btn-sm scroll-click"  role="button"> submit</a>
						</div> -->
						<button class="btn btn-primary btn-lg btn-block" type="submit">submit</button>
						
					
						
						
					</form>
					<div class="collapse collapse-box" id="basic-form1" >
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"  data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="copy-pre">
						</div>
					</div>
				</div>
				<!-- Default Basic Forms End -->   
          </div>    
			
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>
</div>   
@endsection