
@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="{{ asset('assets/vendors/images/coupon-img.png') }}" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue">Rim And Nour !</div>
						</h4>
						<p class="font-18 max-width-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde hic non repellendus debitis iure, doloremque assumenda. Autem modi, corrupti, nobis ea iure fugiat, veniam non quaerat mollitia animi error corporis.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$nbresection}}</div>
								<div class="weight-600 font-14">Sections</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart2"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$nbrecategory}}</div>
								<div class="weight-600 font-14">Categories</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart3"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$nbreproducts}}</div>
								<div class="weight-600 font-14">products</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart4"></div>
							</div>
							<div class="widget-data">
								<div class="h4 mb-0">{{$nbreorders}}</div>
								<div class="weight-600 font-14">Orders</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="card-box mb-30">
				<h2 class="h4 pd-20">Best Selling Products</h2>
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th class="table-plus datatable-nosort">Product</th>
							<th>Name</th>
							<th>Brand</th>
							<th>Section</th>
							<th>Category</th>
							<th>Price</th>
							<th class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach($products as $product)
						<tr>
							<td class="table-plus">
							<?php $product_image_path ="images/product_images/small/".$product->main_image; ?>
							@if(!empty($product->main_image) && file_exists($product_image_path))
								<img width="70" height="70" alt="" src="{{ asset('images/product_images/small/'.$product->main_image) }}">
							@else
								<img width="70" height="70" alt="" src="{{ asset('images/product_images/small/pasImage.png') }}">
							@endif 
							
							</td>
							<td>
								<h5 class="font-16">{{$product['product_name']}}</h5>
								
							</td>
							<td>{{$product->brand->name}}</td>
							<td>{{$product->section->name}}</td>
							<td>{{$product->category->category_name}}</td>
							<td>{{$product->product_price}} DT</td>
							<td>
								<div class="dropdown">
									<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										<i class="dw dw-more"></i>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
										<a class="dropdown-item" target="_blank" href="{{url('product/'.$product->id)}}"><i class="dw dw-eye"></i> View</a>
									</div>
								</div>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				© 2021 Shop 216 - All rights reserved | Powered  by nour and rim 
			</div>
		</div>
	</div>
</div>   
@endsection
@section('apexcharts')
<script src="{{ asset('assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endsection