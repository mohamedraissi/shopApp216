@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Products</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Products</li>
									
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
							<a href="{{url('admin/add-edit-product')}}" style="max-width: 150px; float:right; display: inline-block;" class="btn btn-block btn-success"> Add Product</a>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Products</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table nowrap dataTable no-footer dtr-inline collapsed">
							<thead>
								<tr>
									
									<th>ID</th>
									<th>Product name</th>
                                    <th>Product code</th>
									<th>Product image</th>
									<th>Category</th>
									<th>Section</th>
									<th>Status</th>
									<th>action</th>
									
								</tr>
							    </thead>
							    <tbody>
								@foreach($products as $product)
								<tr>
									
									<td>{{$product->id }}</td>
									<td>{{$product->product_name }}</td>
									<td>{{$product->product_code }}</td>
                                    <td>
									<?php $product_image_path ="images/product_images/small/".$product->main_image; ?>
									@if(!empty($product->main_image) && file_exists($product_image_path))
									<img style="width : 100px;" src="{{ asset('images/product_images/small/'.$product->main_image) }}">
									@else
									<img style="width : 100px;" src="{{ asset('images/product_images/small/pasImage.png') }}">
									@endif 
									</td>
									<td>{{$product->category->category_name}}</td>
									<td>{{$product->section->name}}</td>

									<td>
							
									@if($product->status==1)
										<a class="updateProductStatus "  id="product-{{$product->id }}" product_id="{{$product->id }}" href ="javascript::void(0)"> <span class="badge badge-success">	Active</span> </a>
									@else 
									    <a class="updateProductStatus "  id="product-{{$product->id }}" product_id="{{$product->id }}" href ="javascript::void(0)"> <span class="badge badge-danger">Inactive</span>   </a>
									
									@endif
									</td>

									
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{url('admin/add-edit-product/'.$product->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a class="dropdown-item" href="{{ url('admin/add-options/'.$product->id) }}"><i class="icon-copy dw dw-add"></i> add option</a>
												<a class="dropdown-item" href="{{ url('admin/add-attributes/'.$product->id) }}"><i class="icon-copy dw dw-add"></i> add</a>
												<a class="dropdown-item" href="{{ url('admin/add-images/'.$product->id) }}"><i class="icon-copy dw dw-add"></i> Image</a>
												<a   href="javascript:void(0)" class ="confirmDelete dropdown-item"    record="{{$product->product_name}}" recordid="{{$product->id }}" 
												<?php /* href="{{url('admin/delete-product/'.$product->id) }}" */ ?>>
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
				DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
			</div>
		</div>
	</div>

@endsection
@section('js')

@endsection
@section('css')

@endsection
