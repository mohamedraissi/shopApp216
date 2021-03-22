
@extends('layouts.admin_layout.admin_layout')
@section('content')
	
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('admin/dashboard1')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="{{ asset('images/admin_images/'.Auth::guard('admin')->user()->image)  }}" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="{{ url('assets/image" src="vendors/images/photo2.jpg') }}" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
                            <h5 class="text-center h5 mb-0"> {{ ucwords(Auth::guard('admin')->user()->name) }}</h5>
							<p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										{{ Auth::guard('admin')->user()->email }}
									</li>
									<li>
										<span>Phone Number:</span>
										{{ Auth::guard('admin')->user()->phone}}
									</li>
									<li>
										<span>status:</span>
										@if( Auth::guard('admin')->user()->status)
											active
										@else
											inactive
										@endif
									</li>
									<li>
										<span>Address:</span>
										1807 Holden Street<br>
										San Diego, CA 92115
									</li>
                                    <li>
									      <a href="{{ url('admin/update-admin-details')}}"><span >update admin Information</span> </a>    
                                    </li>
									<li>
									      <a href="{{ url('admin/settings')}}"><span >update admin password</span> </a>    
                                    </li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Settings</a>
										</li>
									</ul>
									<div class="tab-content">	
										<!-- Setting Tab start -->
										<div class="tab-pane fade height-100-p show active" id="setting" role="tabpanel">
											<div class="profile-setting">
											@if(Session::has('error_message'))
						                       <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                   {{ Session::get('error_message')}}
                                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                   </button>
                                                </div>
                                            @endif
											@if(Session::has('success_message'))
											    <div class="alert alert-success" role="alert">
                                                   {{ Session::get('success_message')}}
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
												<form role="form" method="post" action="{{ url('/admin/update-admin-details') }}" name="updateAdminDetails" 
                                                 id ="updateAdminDetails" enctype="multipart/form-data"> @csrf
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
															
															<div class="form-group">
																<label>Admin Email</label>
																<input class="form-control form-control-lg" value="{{Auth::guard('admin')->user()->email }}" readonly="">
															</div>
															<div class="form-group">
																<label>Admin type</label>
																<input class="form-control form-control-lg"  value="{{ Auth::guard('admin')->user()->type}}" readonly="">
															</div>
															<div class="form-group">
																<label>Name</label>
																<input class="form-control form-control-lg " name="admin_name" id="admin_name" value="{{ Auth::guard('admin')->user()->name }}" placeholder="Enter admin name" required="">
								                               
															</div>
															<div class="form-group">
																<label>phone</label>
																<input class="form-control form-control-lg" name="admin_phone" id="admin_phone" value="{{ Auth::guard('admin')->user()->phone }}"  placeholder="Enter new password" required="">
															</div>
															<div class="form-group">
																<label>image</label>
																<input type="file" class="form-control form-control-lg" name="admin_image" id="admin_image">
																@if(!empty(Auth::guard('admin')->user()->image))
																  <a target="_blank" href="{{ url('images/admin_images/'.Auth::guard('admin')->user()->image) }}">View Image</a>
																  <input type="hidden" name="current_admin_image" value="{{ Auth::guard('admin')->user()->image }}">
																@endif    
															</div>

															
															<div class="form-group mb-0">
																<button class="btn btn-primary " type="submit">submit</button>
															</div>
														</li>
														
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
@endsection
@section('js')
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
@endsection
