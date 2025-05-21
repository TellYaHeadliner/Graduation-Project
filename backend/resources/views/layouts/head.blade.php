<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<meta name="X-TOKEN" content="{{ csrf_token() }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="url-home" content="{{ url('/') }}">
<meta name="currency" content="{{ config('custom.currency') }}">
<meta name="position_currency" content="{{ config('custom.format.position_currency') }}">
<title>@yield('title', 'Admin')</title>
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo-roomix-ver3.png') }}" />
<!-- CSS files -->
<script src="https://cdn.jsdelivr.net/npm/imask"></script>
<link href="{{ asset('libs/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/tabler/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
<link href="{{ asset('libs/tabler/plugins/tabler-icon/webfont/tabler-icons.min.css') }}"
				rel="stylesheet"type="text/css">
<link href="{{ asset('libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet"type="text/css">
<link href="{{ asset('libs/Parsley.js-2.9.2/style.css') }}" rel="stylesheet">
<!-- datatable -->
<script src="https://cdn.ckeditor.com/ckfinder/3.5.0/ckfinder.js"></script>
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('libs/datatables/plugins/bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('libs/datatables/plugins/buttons/css/buttons.bootstrap5.min.css') }}">
<link rel="stylesheet"
				href="{{ asset('libs/datatables/plugins/responsive/css/responsive.bootstrap5.min.css') }}">
<style>
				@import url('https://rsms.me/inter/inter.css');

				:root {
								--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
				}

				body {
								font-feature-settings: "cv03", "cv04", "cv11";
				}
</style>
<link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet">
@stack('libs-css')
@stack('custom-css')
