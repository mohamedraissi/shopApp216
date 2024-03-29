
<div class="left-side-bar">
		<div class="brand-logo">
			<a href="index.html">
				<img src="{{asset('assets/vendors/images/deskapp-logo.svg')}}" alt="" class="dark-logo">
				<img src="{{asset('assets/vendors/images/deskapp-logo-white.svg')}}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
				    @if (Session::get('page')=="dashboard")
							@php $active="active"; @endphp
						@else
						 	@php $active=""; @endphp
                     @endif 
				    <li>
						<a href="{{ url ('admin/dashboard') }}" class="dropdown-toggle no-arrow {{$active}}">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>

					@if (Session::get('page')=="settings" || Session::get('page')=="updateAdminDetails"|| Session::get('page')=="addSubAdmin" )
							@php  
							$active="show";
							$style='style=display:block'
							@endphp
						 @else
						 	@php 
							 $active=""; 
							 $style='style="display:none"'
							@endphp
                         @endif
						 


					
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle {{$active}}">
							<span class="micon dw dw-settings"></span><span class="mtext">settings</span>
						</a>
						<ul class="submenu" {{$style}}>
                         @if (Session::get('page')=="settings")
							@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
                         @endif 
						 


							<li><a href="{{url('admin/settings') }}" class="{{$active}}">update admin paswword</a></li>
						@if (Session::get('page')=="updateAdminDetails")
							@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
                         @endif 
						 


							<li><a href="{{url('admin/update-admin-details') }}" class="{{$active}}">update admin details</a></li>
                         
						 @if (Session::get('page')=="addSubAdmin")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif

							<li><a href="{{url('admin/add-subadmin')}}" class="{{$active}}">add admin</a></li>
							</ul>
					</li>	

					@if (Session::get('page')=="orders" || Session::get('page')=="sections" || Session::get('page')=="brands" ||  Session::get('page')=="categories" || Session::get('page')=="banners")
							@php  
							$active="show";
							$style='style=display:block'
							@endphp
						 @else
						 	@php 
							 $active=""; 
							 $style='style="display:none"'
							@endphp
                         @endif
						 


					
					<li class="dropdown {{$active}} ">
						<a href="javascript:;" class="dropdown-toggle ">
							<span class="micon dw dw-box"></span><span class="mtext">Catalogues</span>
						</a>
						<ul class="submenu" {{$style}}>
                         @if (Session::get('page')=="sections")
							@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
                         @endif 
						 
						
                        


							<li><a href="{{url('admin/sections')}}" class="{{$active}}">Sections</a></li>
							@if (Session::get('page')=="brands")
							@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
                         @endif 
						<li><a href="{{url('admin/brands')}}" class="{{$active}}">Brands</a></li>
                         @if (Session::get('page')=="categories")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif

							<li><a href="{{url('admin/categories')}}" class="{{$active}}">Categories</a></li>
							
							
						 @if (Session::get('page')=="products")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif	
							<li><a href="{{url('admin/products')}}" class="{{$active}}">Products</a></li>
						@if (Session::get('page')=="orders")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif	
						 <li><a href="{{url('admin/orders')}}" class="{{$active}}">Orders</a></li>
							
							@if (Session::get('page')=="banners")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif
							<li><a href="{{url('admin/banners')}}" class="{{$active}}">banners</a></li>

							@if (Session::get('page')=="coupons")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif
							<li><a href="{{url('admin/coupons')}}" class="{{$active}}">coupons</a></li>

							@if (Session::get('page')=="options")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif
							<li><a href="{{url('admin/options')}}" class="{{$active}}">Options</a></li>
						</ul>
					</li>
					
				
					
				</ul>
			</div>
		</div>
	</div>