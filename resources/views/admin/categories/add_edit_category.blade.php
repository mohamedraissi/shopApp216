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
	<form name="categoryForm", id="CategoryForm" action="{{url('admin/add-edit-category')}}" method="post" enctype="multipart/form-data">@csrf
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
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Catalogues</li>
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
							<h4 class="text-blue h4">Add Category </h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						
					</div>
					<form>
						<div class="row">

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Category Name</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter Category Name">
							</div>
						</div>
 
						<div id="appendCategoriesLevel" class="col-md-6 col-sm-12">
						@include('admin.categories.append_categories_level')
						</div>
						
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Select Section</label>
							<div class="col-sm-12 col-md-12">
							<select name="section_id" id="section_id" class="custom-select2 form-control select2-hidden-accessible" style ="width:100%;">
								
								@foreach($getSections as $section)
								<option value="{{$section->id}}">{{ $section->name }}</option> 
								@endforeach
							</select>	
							</div>
						</div>  
						


						<div class="form-group col-md-6 col-sm-12">
							<label for="exampleInputFile" class="col-sm-12  col-form-label">Category Image</label>
							<div class="col-sm-12 col-md-12">
								<div class="custom-file ">
									<input type="file" class="custom-file-input form-control" id="category_image" name="category_image">
									<label class="custom-file-label col-sm-12  col-form-label">Choose file</label>
								</div>
							</div>
							   
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Category Discount</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="category_discount" name="category_discount" placeholder="Enter Category Name">
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Category Description</label>
							<div class="col-sm-12 col-md-12">
								<textarea name="description" id="description" type="text" class="form-control"  placeholder="Enter ..."></textarea >
							</div>
						</div>
						
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Category URL</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control"  id="url" name="url" placeholder="Enter Category Name">
							</div>
						</div>	


						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Title</label>
							<div class="col-sm-12 col-md-12">
							<textarea  id="meta_title" name="meta_title" type="text" class="form-control"  placeholder="Enter..."></textarea>
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Description</label>
							<div class="col-sm-12 col-md-12">
							<textarea id="meta_description" name="meta_description" type="text" class="form-control"  placeholder="Enter..."></textarea>
							</div>
						</div>

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Meta Keywords </label>
							<div class="col-sm-12 col-md-12">
								<textarea  id="meta_keywords" name="meta_keywords" type="text" class="form-control"  placeholder="Enter..."></textarea>
							</div>
						</div>

					<div class ="card-footer">
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