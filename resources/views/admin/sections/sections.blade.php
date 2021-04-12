@extends('layouts.admin_layout.admin_layout')
@section('content')
<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
		@if(Session::has('success_message'))
			<div class="alert alert-success" role="alert">
             {{ Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
             </div>
        @endif
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Sections</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Sections</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
							<a href="{{url('admin/add-edit-section')}}" style="max-width: 150px; float:right; display: inline-block;" class="btn btn-block btn-success"> Add Section</a>
								
							</div>
						</div>
					</div>
				</div>
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">Sections</h4>
						
					</div>
					<div class="pb-20">
						<table class="data-table table nowrap dataTable no-footer dtr-inline collapsed">
							<thead>
								<tr>
									
									<th>ID</th>
									<th>Name</th>
									<th>Status</th>
									<th>action</th>
									
								</tr>
							</thead>
							<tbody>
								@foreach($sections as $section)
								<tr>
									
									<td>{{$section->id }}</td>
									<td>{{$section->name }}</td>
									<td>
									@if($section->status==1)
										<a class="updateSectionStatus"  id="section-{{$section->id }}" section_id="{{$section->id }}" href ="javascript::void(0)"> <span class="badge badge-success">	Active</span> </a>
									@else 
									<a class="updateSectionStatus"  id="section-{{$section->id }}" section_id="{{$section->id }}" href ="javascript::void(0)"><span class="badge badge-danger">	Inactive</span>  </a>
									@endif
									</td>

									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
											<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
												<a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
												<a class="dropdown-item" href="{{url('admin/add-edit-section/'.$section->id) }}"><i class="dw dw-edit2"></i> Edit</a>
												<a  href="javascript:void(0)" class ="confirmDelete dropdown-item"    record="section" recordid="{{$section->id }}" ><i class="dw dw-delete-3"></i> Delete</a>
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
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('js')
	<script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<!-- buttons for Export datatable -->
	<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
@endsection