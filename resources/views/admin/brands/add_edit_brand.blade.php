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
	<form name="brandForm", id="brandForm" @if(empty($brand['id'])) action="{{url('admin/add-edit-brand') }}" 
	@else action="{{url('admin/add-edit-brand/'.$brand['id'] ) }}" @endif  method="post" enctype="multipart/form-data">@csrf
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Brands</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Brands</li>
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
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						
					</div>
					<form>
						<div class="row">

						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Brand Name</label>
							<div class="col-sm-12 col-md-12">
								<input  type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand Name" 
								@if (!empty ($brand['name'] )) value="{{$brand['name']}}" @else value="{{old ('name') }}" @endif>
							</div>
						</div>
 
					
	
				    </div>
                    <div class ="card-footer">
					<button type ="submit" class="btn btn-primary"> submit </button>
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