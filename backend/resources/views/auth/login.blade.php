<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<meta name="X-TOKEN" content="{{ csrf_token() }}">
	<title>@yield('title', 'Admin')</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/light-icon.png') }}" />
	<!-- CSS files -->
	<link href="{{ asset('/libs/tabler/dist/css/tabler.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('/libs/Parsley.js-2.9.2/style.css') }}" rel="stylesheet">
	<script src="{{ asset('/libs/tabler/dist/js/tabler.min.js') }}" defer></script>
	<script src="{{ asset('/libs/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
	<script src="{{ asset('/libs/Parsley.js-2.9.2/parsley.min.js') }}"></script>
	<style>
		@import url('https://rsms.me/inter/inter.css');

		:root {
			--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
		}

		body {
			font-feature-settings: "cv03", "cv04", "cv11";
		}
	</style>
	
</head>

<body class="border-top-wide d-flex flex-column overflow-hidden">
	<div class="page page-center background-container">
		<div class="container-tight py-4">
			<x-form :action="route('login.post')" class="glass-card login-container" type="post" :validate="true">
				<div class="card-body p-4 shadow-sm">
					<h2 class="card-title mb-4 text-center text-3xl font-bold text-white">{{ __('WELCOME TO ROOMIX') }}
					</h2>
					<div class="logo-container mb-4 text-center">
						<img style="max-height: 150px" class="img-fluid mx-auto"
							src="{{ asset('assets/images/light-logo.png') }}" alt="">
					</div>
					<p class="mb-4 text-center text-white">{{ __('Để đăng nhập được nhập đầy đủ thông tin bên dưới') }}
					</p>
					<div class="mb-3">
						<label class="form-label mb-2 text-sm font-medium text-white">{{ __('Tài khoản') }}</label>
						<x-input-email name="email" :required="true"
							class="form-input w-full rounded-lg px-4 py-3 focus:outline-none"
							placeholder="Nhập email..." />
						@error('email')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>
					<div class="mb-3">
						<label class="form-label mb-2 text-sm font-medium text-white">{{ __('Mật khẩu') }}</label>
						<x-input-password name="password" :required="true"
							class="form-input w-full rounded-lg px-4 py-3 focus:outline-none"
							placeholder="Nhập mật khẩu..." />
						@error('password')
							<span class="text-danger">{{ $message }}</span>
						@enderror
					</div>

					<div class="form-footer">
						<button type="submit"
							class="btn-gradient w-full rounded-lg py-3 font-semibold text-white focus:outline-none">
							{{ __('Đăng nhập') }}
						</button>
					</div>
				</div>
			</x-form>
		</div>
	</div>
</body>
</html>

<x-alert />

<style>
	.background-container {
		position: relative;
		width: 100%;
		height: 100vh;
		z-index: 1;
		background-image: url('{{ asset('assets/images/bg-admin.jpg') }}');
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}

	.glass-card {
		background: rgba(255, 255, 255, 0.25);
		backdrop-filter: blur(10px);
		-webkit-backdrop-filter: blur(10px);
		border: 1px solid rgba(255, 255, 255, 0.3);
		border-radius: 16px !important;
		box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
		max-width: 450px;
		margin: 0 auto;
	}

	.btn-gradient {
		background: linear-gradient(135deg, #0056B3, #00A3FF) !important;
		transition: all 0.3s ease;
		border: none !important;
	}

	.btn-gradient:hover {
		background: linear-gradient(135deg, #00A3FF, #0056B3) !important;
		transform: translateY(-2px);
		box-shadow: 0 10px 25px rgba(0, 83, 179, 0.5);
	}

	.form-input,
	.form-control {
		background: rgba(255, 255, 255, 0.8) !important;
		border: 2px solid rgba(255, 255, 255, 0.5) !important;
		color: #333 !important;
		transition: all 0.3s ease;
		box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
	}

	.form-input:focus,
	.form-control:focus {
		background: rgba(255, 255, 255, 0.95) !important;
		border-color: rgba(0, 123, 255, 0.7) !important;
		box-shadow: 0 0 15px rgba(0, 123, 255, 0.3) !important;
	}

	.form-input::placeholder,
	.form-control::placeholder {
		color: #666;
		opacity: 0.8;
	}

	.logo-container {
		animation: pulse 2s infinite;
	}

	@keyframes pulse {
		0% {
			transform: scale(1);
		}

		50% {
			transform: scale(1.05);
		}

		100% {
			transform: scale(1);
		}
	}

	.login-container {
		animation: fadeIn 1s ease-out;
		z-index: 10;
		position: relative;
	}

	@keyframes fadeIn {
		from {
			opacity: 0;
			transform: translateY(20px);
		}

		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Override any existing styles */
	.page-center {
		display: flex;
		align-items: center;
		justify-content: center;
		min-height: 100vh;
	}

	.form-label {
		color: #000 !important;
		font-weight: 500;
	}

	/* Ensure input text is clearly visible */
	input.form-control,
	input.form-input {
		font-size: 1rem;
		font-weight: normal;
	}
</style>
