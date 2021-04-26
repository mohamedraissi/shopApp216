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
							<select name="category_id" id="category_id" class="custom-select2 form-control select2-hidden-accessible" style ="width:100%;">
							<option value="">select Category</option> 
							
							@foreach($categories as $section)
							   <optgroup label="{{ $section['name'] }}"></optgroup>
							   @foreach($section['categories'] as $category)
							     <option value="{{ $category['id'] }}" @if(!empty(@old('category_id'))&& $category['id']==@old('category_id')) selected="" 
								 @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$category['id']) selected="" @endif>{{ $category['category_name'] }}
								 </option> 
								   @foreach($category['subcategories'] as $subcategory)
							         <option value="{{ $subcategory['category_name'] }}" @if(!empty(@old('category_id'))&& $category['id']==@old('category_id')) selected="" 
									 @elseif(!empty($productdata['category_id']) && $productdata['category_id']==$subcategory['id']) selected="" @endif>{{ $subcategory['category_name'] }}
								     </option> 
							       @endforeach
							   @endforeach

							@endforeach	
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
							<label class="col-sm-12  col-form-label">select brand</label>
							<div class="col-sm-12 col-md-12">
								<select name="brand" id="" class="custom-select2 form-control select2-hidden-accessible" style ="width:100%;">
								<option value="">select brand</option>	
								@foreach($brands as $brand)
									<option value="{{$brand->id}}">{{$brand->name}}</option>
								@endforeach
								</select>
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
							<label for="exampleInputFile" class="col-sm-12  col-form-label">product  video</label>
							<div class="col-sm-12 col-md-12"> 
								<div class="custom-file ">
									<input type="file" class="custom-file-input form-control" id="product_video" name="product_video">
									<label for="product_video" class="custom-file-label col-sm-12  col-form-label">Choose file</label>
								</div>
								
							    @if(!empty($productdata['product_video']))
							       <div><a href="{{ url('videos/product_videos/'.$productdata['product_video']) }}" download>Download</a>
							      &nbsp;|&nbsp;
							     <a class="confirmDelete ml-4"  href="javascript:void(0)" record="product-video" recordid="{{$productdata['id'] }}">  Delete Video </a>
							     </div>
							    @endif 
								

								
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
								@if(!empty($productdata['main_image'])) 
										<div class="d-flex align-items-center"> <img style="width:100px; margin-top:5px; " src="{{asset('images/product_images/small/'.$productdata['main_image']) }}" alt="">
										<a class="confirmDelete ml-4"  href="javascript:void(0)" record="product-image" recordid="{{$productdata['id'] }}">  Delete image </a>
										</div>
									@endif
							</div>
							   
						</div>

                        <div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">product code</label>
							<div class="col-sm-12 col-md-12">
                            <input  type="text" class="form-control" name="product_code" id="product_code" placeholder="Enter product Code" 
								@if (!empty ($productdata['product_code'] )) value="{{$productdata['product_code']}}" @else value="{{old ('product_code') }}" @endif>
								
							</div>
							<label class="col-sm-12  col-form-label">Product Discount %</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="product_discount" name="product_discount" placeholder="Enter product Discount" 
								@if (!empty ($productdata['product_discount'] )) value="{{$productdata['product_discount']}}" @else value="{{old ('product_discount') }}" @endif>
							</div>
						</div>
						

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Product Description</label>
							<div class="col-sm-12 col-md-12">
								<textarea name="product_description" id="product_description" class="form-control"  placeholder="Enter ..." >
								@if (!empty ($productdata['product_description'] )) {{$productdata['product_description']}} @else {{old ('product_description') }} @endif</textarea >
							</div>
						</div>

                        
					

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Description</label>
							<div class="col-sm-12 col-md-12">
							<textarea id="product_meta_description" name="product_meta_description" type="text" class="form-control"  placeholder="Enter...">
							@if (!empty ($productdata['product_meta_description'] )) {{$productdata['product_meta_description']}} @else {{old ('product_meta_description') }} @endif
							</textarea>
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Keywords </label>
							<div class="col-sm-12 col-md-12">
								<textarea  id="product_meta_keyword" name="product_meta_keyword" type="text" class="form-control"  placeholder="Enter...">
								@if (!empty ($productdata['product_meta_keyword'] )) {{$productdata['product_meta_keyword']}} @else {{old ('product_meta_keyword') }} @endif</textarea>
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