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
	<form name="addattributeForm" id="addattributeForm" method="post" 
	      action="{{url('admin/add-value/'.$optiondata['id']) }}" >@csrf
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
									<li class="breadcrumb-item active" aria-current="page">Option</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							
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
                
						<div class="form-group col-md-6 col-sm-12">
							<label class="col-sm-12  col-form-label">Option Name: {{$optiondata['name']}} </label>
							
						</div>

                       
                  
						
						</div>
                        <div class="form-group col-md-6 col-sm-12">
                          <div class="field_wrapper">
                              <div>
                                  <input id="value" name="value[]" type="text" name="value[]" value="" placeholder="value" style="width:120px;" required="" />
	
                                  <a href="javascript:void(0);" class="add_button_value" title="Add field">Add</a>
                               </div>
                          </div>
                        </div>
                         

                    
					<div class ="card-footer col-sm-12">
					<button type ="submit" class="btn btn-primary"> add Value </button>
					</div>
						
						
			</div>
		</div>	
 </form>
            
	        <form name="editattributeForm" id="editattributeForm" method="post" 
	         action="{{url('admin/edit-value/'.$optiondata ['id']) }}" >@csrf
			
			  <div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Added Option values</h4>
					</div>
					<div class="pb-20">
						<table class="data-table table nowrap dataTable no-footer dtr-inline collapsed">
							<thead>
								<tr>
									
									<th>ID</th>
									<th>value</th>
                                    <th>status</th>
                                    <th>Action</th>
                                    
									
								</tr>
							</thead>
							<tbody>
								@foreach($optiondata['values'] as $value)
								<input style="display: none;" type="text" name="valId[]" value="{{ $value['id'] }}">
								<tr>
									
									<td>{{$value['id'] }}</td>
									<td><input type="text" name="value[]" value="{{$value['value'] }}" required=""></td>
									<td>
							
									@if($value['status']==1)
										<a class="updatevalueStatus "  id="value-{{ $value['id'] }}" value_id="{{ $value['id'] }}" href ="javascript::void(0)"> <span class="badge badge-success">	Active</span> </a>
									@else 
									    <a class="updatevalueStatus "  id="value-{{ $value['id'] }}" value_id="{{ $value['id'] }}" href ="javascript::void(0)"> <span class="badge badge-danger">Inactive</span>   </a>
									
									@endif
									</td>
                                    <td>
									<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>

												<a   href="javascript:void(0)" class ="confirmDelete dropdown-item" id="value-{{ $value['id'] }}" value_id="{{ $value['id'] }}" record="value" recordid="{{ $value['id']  }}">      
												
												 <i class="dw dw-delete-2"></i> Delete</a>
												 
												
											</div>
										</div>
									</td>
									
								@endforeach
							</tbody>
						</table>
					</div>
					<div class ="card-footer col-sm-12">
					<button type ="submit" class="btn btn-primary"> update value </button>
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