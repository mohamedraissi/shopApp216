<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>shop 216</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ url('vendors/images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ url('vendors/images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('vendors/images/favicon-16x16.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ url('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url ('assets/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">"
	<link rel="stylesheet" type="text/css" href="{{ url('assets/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('assets/vendors/styles/style.css') }}">
	@yield('css')
	<!-- Global site tag (gtag.js) - Google Analytics -->
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>

    @include('layouts.admin_layout.admin_pre_loader')

	@include('layouts.admin_layout.admin_header')

	@include('layouts.admin_layout.admin_right_sidebar')

	@include('layouts.admin_layout.admin_left_sidebar')
	<div class="mobile-menu-overlay"></div>

	@yield('content')
	
	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
	
	<script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	
    <!-- bootstrap-tagsinput js -->
	<script src="{{ asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/admin_js/admin_scripts.js')}}"></script>
	
	<!--SweetAlert Script -->
	<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@9 "></script>

	
	
</body>
</html>