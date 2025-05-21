<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

				<head>
								@include('layouts.head')
				</head>

				<body>
								<div class="page layout overflow-x-hidden">
												<x-admin-sidebar-left />
												{{-- @include('layouts.sidebar-left') --}}
												@include('layouts.sidebar-top')
												<div class="page-wrapper">
																@section('breadcrumbs')
																				@include('layouts.partials.breadcrumbs')
																@show
																@yield('content')
																{{-- @include('layouts.modal.modal-logout')
																@include('layouts.modal.modal-delete') --}}
												</div>
								</div>
								@include('layouts.scripts')
								{{-- @include('layouts.alert') --}}
				</body>

</html>
