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
	<form name="couponForm", id="couponForm" @if(empty($coupon['id'])) action="{{url('admin/add-edit-coupon') }}" 
	@else action="{{url('admin/add-edit-coupon/'.$coupon['id'] ) }}" @endif  method="post" enctype="multipart/form-data">@csrf
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
							<h4 class="text-blue h4">{{$title}} </h4>
							<p class="mb-30">All bootstrap element classies</p>
						</div>
						
					</div>
					<form>
						<div class="row">
							@if(empty($coupon['coupon_code']))
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label" for="coupon_option">Coupon option</label><br>
							<span> <input id="AutomaticCoupon" checked="" type="radio" name="coupon_option" value="Automatic">&nbsp;Automatic&nbsp;&nbsp;
                            <span> <input id="ManualCoupon" type="radio" name="coupon_option" value="Manual">&nbsp;Manual&nbsp;&nbsp;
						</div>
						<div class="form-group col-md-6 col-sm-12" style="" id="couponField">
							<label for="coupon_code">Coupon Code</label>
							<input  type="text" class="form-control" name="coupon_code" id="coupon_code" 
                                placeholder="Enter Coupon code">
						</div>		 
						@else
						<input type="hidden" name="coupon_option" value="{{ $coupon['coupon_option'] }}">
						<input type="hidden" name="coupon_code" value="{{ $coupon['coupon_code'] }}">
						<div class="form-group col-md-6 col-sm-12" >
							<label for="coupon_code">Coupon Code</label>
							<span>{{$coupon['coupon_code']}}</span>
						</div>
						@endif
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label" for="coupon_type">Coupon Type</label><br>
							<span> <input type="radio" name="coupon_type" value="Multiple times" 
							@if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Multiple times") checked="" @elseif(isset($coupon['coupon_type'])) checked="" @endif >&nbsp;Multiple times&nbsp;&nbsp;
                            <span> <input type="radio" name="coupon_type" value="Single times" @if(isset($coupon['coupon_type'])&&$coupon['coupon_type']=="Single times") checked="" @endif >&nbsp;Single times&nbsp;&nbsp;
								
						</div>
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label" for="amount_type">Amount Type</label><br>
							<span> <input type="radio" name="amount_type" value="Percentage " @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Percentage") checked="" @endif>&nbsp;Percentage &nbsp;(In %)&nbsp;
                            <span> <input type="radio" name="amount_type" value="Fixed" @if(isset($coupon['amount_type'])&&$coupon['amount_type']=="Fixed") checked="" @endif>&nbsp;Fixed&nbsp;(in DT)&nbsp;
								
						</div>
						<div class="form-group col-md-6 col-sm-12" >
							<label class="col-sm-12  col-form-label">Amount</label>
								<input  type="number" class="form-control" name="amount" id="amount" 
                                placeholder="Enter Amount" require="" @if(isset($coupon['amount'])) value="{{ $coupon['amount'] }}" @endif>
						</div>	
                        
                        <div class="form-group col-md-6 col-sm-12" >
							<label for="categories">Select Categories</label>
                            <select name="categories[]"  class="custom-select2 form-control select2-hidden-accessible" multiple="" style="width: 100%";>
							<option value="">select Category</option> 
							
							@foreach($categories as $section)
							   <optgroup label="{{ $section['name'] }}"></optgroup>
							   @foreach($section['categories'] as $category)
							     <option value="{{ $category['id'] }}"@if(in_array($category['id'],$selCats)) selected="" @endif >{{ $category['category_name'] }}
								 </option> 
								   @foreach($category['subcategories'] as $subcategory)
							         <option value="{{ $subcategory['category_name'] }}" @if(in_array($subcategory['id'],$selCats)) selected="" @endif>{{ $subcategory['category_name'] }}
								     </option> 
							       @endforeach
							   @endforeach

							@endforeach	
							</select>	
								
                        </div>

						<div class="form-group col-md-6 col-sm-12" >
							<label for="users">Select Users</label>
                            <select name="users[]"  class="custom-select2 form-control select2-hidden-accessible" multiple="" style="width: 100%" >
						@foreach($users as $user)
						<option value="{{ $user['email'] }}" @if(in_array($user['email'],$selUsers)) selected="" @endif>{{ $user['email'] }}</option>
							@endforeach	
							</select>	
						</div>
						<div class="form-group col-md-6 col-sm-12" > Expiry Date :
	<input type="date" style="height: 50px;width: 260px;" placeholder="Enter Expiry date:"  name="expiry_date" 
	id="expiry_date" date-inputmask-alias="datetime" date-inputmask-inputformat="dd/mm/yyyy" data-mask required="" @if(isset($coupon['expiry_date'])) value="{{ $coupon['expiry_date'] }}" @endif>
	<div class="input">
		<div class="result"><span></span></div>
	</div>

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