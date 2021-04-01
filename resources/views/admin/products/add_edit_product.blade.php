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
	<form name="productForm", id="ProductForm" @if(empty($productdata['id'])) action="{{url('admin/add-edit-product') }}" 
	@else action="{{url('admin/add-edit-product/'.$productdata['id'] ) }}" @endif  method="post" enctype="multipart/form-data">@csrf
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
					<form>
						<div class="row">
                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Select Category</label>
							<div class="col-sm-12 col-md-12">
							<select name="category_id" id="section_id" class="custom-select2 form-control select2-hidden-accessible" style ="width:100%;">
							<option value="0">select Category</option> 
								
							</select>	
							</div>
						</div> 
                        
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">product Name</label>
							<div class="col-sm-12 col-md-12">
                                <input  type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product Code" 
								@if (!empty ($productdata['product_name'] )) value="{{$productdata['product_name']}}" @else value="{{old ('product_name') }}" @endif>
							</div>
						</div>

                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">product code</label>
							<div class="col-sm-12 col-md-12">
                            <input  type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter product Code" 
								@if (!empty ($productdata['product_code'] )) value="{{$productdata['product_code']}}" @else value="{{old ('product_code') }}" @endif>
								
							</div>
						</div>
                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">product color</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control" name="product_color" id="product_color" placeholder="Enter product Color" 
								@if (!empty ($productdata['product_color'] )) value="{{$productdata['product_color']}}" @else value="{{old ('product_color') }}" @endif>
							</div>
						</div>

                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">product Price</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control" name="product_price" id="product_price" placeholder="Enter product Price" 
								@if (!empty ($productdata['product_price'] )) value="{{$productdata['product_price']}}" @else value="{{old ('product_price') }}" @endif>
							</div>
						</div>
                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Product Discount %</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="product_discount" name="product_discount" placeholder="Enter product Discount" 
								@if (!empty ($productdata['product_discount'] )) value="{{$productdata['product_discount']}}" @else value="{{old ('product_discount') }}" @endif>
							</div>
						</div>
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Product Weight</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="product_weight" name="product_weight" placeholder="Enter product Weight" 
								@if (!empty ($productdata['product_weight'] )) value="{{$productdata['product_weight']}}" @else value="{{old ('product_weight') }}" @endif>
							</div>
						</div>
						
						<div class="form-group col-md-6 col-sm-12">
							<label for="exampleInputFile" class="col-sm-12  col-form-label">product Main Image</label>
							<div class="col-sm-12 col-md-12">
							@if(empty($productdata['product_image'])) 
								<div class="custom-file ">
									<input type="file" class="custom-file-input form-control" id="main_image" name="main_image">
									<label for="main_image" class="custom-file-label col-sm-12  col-form-label">Choose file</label>
								</div>
								@endif
							</div>
							   
						</div>
                        <div class="form-group col-md-6 col-sm-12">
							<label for="exampleInputFile" class="col-sm-12  col-form-label">product Main video</label>
							<div class="col-sm-12 col-md-12">
							@if(empty($productdata['product_video'])) 
								<div class="custom-file ">
									<input type="file" class="custom-file-input form-control" id="main_video" name="main_video">
									<label for="main_video" class="custom-file-label col-sm-12  col-form-label">Choose file</label>
								</div>
								@endif
							</div>
							   
						</div>
						

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Product Description</label>
							<div class="col-sm-12 col-md-12">
								<textarea name="description" id="description" class="form-control"  placeholder="Enter ..." >
								@if (!empty ($productdata['description'] )) {{$productdata['description']}} @else {{old ('description') }} @endif</textarea >
							</div>
						</div>

                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Wash Care </label>
							<div class="col-sm-12 col-md-12">
								<textarea name="wash_care" id="wash_care" class="form-control"  placeholder="Enter ..." >
								@if (!empty ($productdata['wash_care'] )) {{$productdata['wash_care']}} @else {{old ('wash_care') }} @endif</textarea >
							</div>
						</div>
						
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Product URL</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="url" name="url" placeholder="Enter product Name"
								@if (!empty ($productdata['url'] )) value="{{$productdata['url']}}" @else value="{{old ('url') }}" @endif>
							</div>
						</div>	


						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Title</label>
							<div class="col-sm-12 col-md-12">
							<textarea  id="meta_title" name="meta_title" type="text" class="form-control"  placeholder="Enter...">
							@if (!empty ($productdata['meta_title'] ))  {{$productdata['meta_title']}} @else {{old ('meta_title') }} @endif
							</textarea>
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Description</label>
							<div class="col-sm-12 col-md-12">
							<textarea id="meta_description" name="meta_description" type="text" class="form-control"  placeholder="Enter...">
							@if (!empty ($productdata['meta_description'] )) {{$productdata['meta_description']}} @else {{old ('meta_description') }} @endif
							</textarea>
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Keywords </label>
							<div class="col-sm-12 col-md-12">
								<textarea  id="meta_keywords" name="meta_keywords" type="text" class="form-control"  placeholder="Enter...">
								@if (!empty ($productdata['meta_keywords'] )) {{$productdata['meta_keywords']}} @else {{old ('meta_keywords') }} @endif</textarea>
							</div>
						</div>

					<div class ="card-footer col-sm-12">
					<button type ="submit" class="btn btn-primary"> submit </button>
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