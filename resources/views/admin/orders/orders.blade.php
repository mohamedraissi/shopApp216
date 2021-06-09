<?php  use App\models\Product; ?>
@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Orders</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Orders</li>
									
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
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
						<h4 class="text-blue h4">Orders</h4>
					</div>
					<div class="pb-20">
					<div class="table-responsive">     
						<table class="data-table table nowrap dataTable no-footer dtr-inline collapsed">
							<thead>
								<tr>
									
									<th>Order ID</th>
									<th>Order date</th>
                                    <th>Customer Name</th>
									<th>Customer Email</th>
									<th>Order Products</th>
									<th>Order status</th>
									<th>Payment Method</th>
									<th>Order Amount</th>
									<th>action</th>
									
								</tr>
							    </thead>
							    <tbody>
								@foreach($orders as $order)
								<tr>
									
									<td>{{ $order['id'] }}</td>
									<td>{{ date('d-m-Y', strtotime($order['created_at'])) }}</td>
									<td>{{ $order['name'] }}</td>
									<td>{{ $order['email'] }}</td>
									<td>@foreach($order['orders_products'] as $pro)
                                                    {{ $pro['product_code']  }} ( {{ $pro['product_qty'] }} )<br>
                                            @endforeach</td>
									<td>{{ $order['order_status'] }}</td>
									<td>{{ $order['payment_method'] }}</td>
									<td>{{ $order['grand_total'] }}</td>
									
									<td><a class="dropdown-item" href="{{ url('admin/orders/'.$order['id']) }}"><i class="dw dw-eye"></i> View</a>
									@if($order['order_status']=="Shipped" || 
									$order['order_status']=="Delivered")
									<a class="dropdown-item" target="_blank" href="{{ url('admin/view-order-invoice/'.$order['id']) }}"><i class="fas fa-print"></i>Print</a>
									@endif
									</td>
									
		
											</div>
										</div>
									</td> 
								</tr>
								@endforeach
							</tbody>
						</table>
						</div>
					</div>
				</div>
				<!-- Simple Datatable End -->
			
				
				
			</div>
			<div class="footer-wrap pd-20 mb-20 card-box">
				© 2021 Shop 216 - All rights reserved | Powered  by nour and rim 
			</div>
		</div>
	</div>

@endsection
@section('js')

@endsection
@section('css')

@endsection
