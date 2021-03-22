
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
					@if (Session::get('page')=="sections" || Session::get('page')=="categories")
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
							<span class="micon dw dw-house-1"></span><span class="mtext">Catalogues</span>
						</a>
						<ul class="submenu" {{$style}}>
                         @if (Session::get('page')=="sections")
							@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
                         @endif 
						 


							<li><a href="{{url('admin/sections')}}" class="{{$active}}">Sections</a></li>
                         @if (Session::get('page')=="categories")
						 	@php $active="active"; @endphp
						 @else
						 	@php $active=""; @endphp
						 @endif

							<li><a href="{{url('admin/categories')}}" class="{{$active}}">Categories</a></li>
							
						</ul>
					</li>
					
				
					
				</ul>
			</div>
		</div>
	</div>