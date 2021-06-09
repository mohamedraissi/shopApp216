@extends('layouts.admin_layout.admin_layout')
@section('content')

<div class="main-container">
		@if ($errors->any())
			<div class="alert alert-danger" style="margin-top:10px;">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
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
	<form name="addOptionsForm" id="addOptionForm" method="post" 
	      action="{{url('admin/add-options/'.$productdata['id']) }}" >@csrf
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Catalogues</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Product</li>
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
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">{{$title}} </h4>
						</div>
						
					</div>
					
						<div class="row">
                
						<div class="form-group col-md-9 col-sm-12">
							<label class="col-sm-12  col-form-label">product Name: {{$productdata['product_name']}} </label>
                            <label class="col-sm-12  col-form-label mt-1">product code: {{$productdata['product_code']}} </label>
                            <div class="mb-30">
									<h5 class="text-blue h5">Select Value</h5>
									<div id="text-values" class="bootstrap-tagsinput">
									
                                    </div>
							</div>
							@if(!empty($productdata['values']))
							<div class="pb-20">
						<table class="data-table table nowrap dataTable no-footer dtr-inline collapsed">
							<thead>
								<tr>
									<th>option</th>
                                    <th>value</th>
									<th>Action</th>
								</tr>
							    </thead>
							    <tbody>
								
								@foreach($productdata['values'] as $value)
									@if(isset($value))
								<tr>
									<td>{{$value['option']["name"] }}</td>
									<td>{{$value['value'] }}</td>
									<td>
									<a   href="javascript:void(0)" class ="confirmDelete dropdown-item"    record="option-in-product" recordid="{{$value['pivot']['product_id'] }}/{{$value['pivot']['productable_id'] }}" 
												<?php /* href="{{url('admin/delete-product/'.$product->id) }}" */ ?>>
												 <i class="dw dw-delete-2"></i> Delete</a>
									</td>
								</tr>
								@endif
								@endforeach
							</tbody>
						</table>
					</div>
							@endif
						</div>

                        <div class="col-md-3 col-sm-12">
                            <input type="hidden" name="values" id="values"   />
							<input type="hidden" name="options" id="options"  />
                                    @foreach($options as $option)
                                        <label class="weight-600">{{$option['name']}}</label>
                                        @foreach($option['values'] as $value)
										
                                            <div class="custom-control custom-checkbox mb-5">
                                                <input type="checkbox" class="custom-control-input" data-id="{{$value['id']}}" option-id="{{$option['id']}}" value="{{$value['id']}}" id="value-{{$value['value']}}" name="value[]">
                                                <label class="custom-control-label" for="value-{{$value['value']}}">{{$value['value']}}</label>
                                            </div>
                                            
                                        @endforeach  
                                    @endforeach  
                                    
						</div>

					<div class ="card-footer col-sm-12">
					<button type ="submit" class="btn btn-primary"> add option </button>
					</div>
						
						
			</div>
		</div>	
 </form>
            
	       




					<div class="collapse collapse-box" id="basic-form1">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left" data-clipboard-target="#copy-pre"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre hljs" id="copy-pre">

</div>

@endsection