@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
		@if(Session::has('success_message'))
			<div class="alert alert-success" role="alert">
             {{ Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>
        @endif
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Banners</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Banners</li>
									
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
							<a href="{{url('admin/add-edit-banner')}}" style="max-width: 150px; float:right; display: inline-block;" class="btn btn-block btn-success"> Add Banners</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Banners</h4>
						<p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p>
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									
									<th>ID</th>
									<th>image</th>
                                    <th>link</th>
									<th>title</th>
                                    <th>alt</th>
									<th>status</th>
									<th>Action</th>
									
									
								</tr>
							    </thead>
							    <tbody>
								@foreach($banners as $banner)
								<tr>
									
									<td>{{$banner['id'] }}</td>
                                    <td>
                                       <img style="width: 180px" src="{{ asset('/images/banners_images/'.$banner['banner_image']) }}">
                                    </td>
									<td>{{$banner['link'] }}</td>
                                    <td>{{$banner['title'] }}</td>
                                    <td>{{$banner['alt'] }}</td>
                                   
                                    

									<td>
									@if($banner['status']==1)
										<a class="updateBannerStatus "  id="banner-{{$banner ['id'] }}" banner_id="{{$banner ['id'] }}" href ="javascript::void(0)"> <span class="badge badge-success">	Active</span> </a>
									@else 
									<a class="updateBannerStatus"  id="banner-{{$banner ['id'] }}" banner_id="{{$banner ['id'] }}" href ="javascript::void(0)"><span class="badge badge-danger">Inactive</span>  </a>
									@endif
									</td>

									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{url('admin/add-edit-banner/'.$banner['id']) }}"><i class="dw dw-edit2"></i> Edit</a>

												<a   href="javascript:void(0)" class ="confirmDelete dropdown-item"    record="banner" recordid="{{$banner['id'] }}" 
												<?php /* href="{{url('admin/delete-banner/'.$banner['id'] }}" */ ?>>
												 <i class="dw dw-delete-2"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								@endforeach  
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->
			
				
				
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				DeskApp - Bootstrap 4 Admin Template By <a href="#" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>

@endsection
@section('js')

@endsection
@section('css')

@endsection
