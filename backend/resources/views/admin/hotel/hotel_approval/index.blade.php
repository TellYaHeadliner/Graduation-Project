@extends('layouts.master')

@push('libs-css')
@endpush

@section('content')
	<div class="page-body">
		<div class="container-xl">
			<div class="card">
				<div class="card-header justify-content-between">
					<h2 class="mb-0">{{ __('Danh sách khách sạn') }}</h2>
				</div>
				<div class="card-body">
					<div class="table-responsive position-relative">
						<x-admin.partials.toggle-column-datatable />
						{{ $dataTable->table(['class' => 'table table-bordered', 'style' => 'min-width: 900px;'], true) }}
						<div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
								<div class="modal-content rounded-3 shadow">
									<div class="modal-header border-0 pb-0">
										<h5 class="modal-title fw-bold text-danger">
											<i class="ti ti-alert-circle me-2"></i> {{ __('Bạn có chắc?') }}
										</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Đóng"></button>
									</div>

									<div class="modal-body">
										<p class="mb-3">
											{{ __('Nếu bạn tiếp tục, khách sạn này sẽ bị từ chối khỏi hệ thống.') }}
										</p>

										<x-form id="modalFormDelete" action="#" type="delete">
											<div class="mb-3">
												<label for="reason" class="form-label fw-semibold">
													<i class="ti ti-message-dots me-1"></i> {{ __('Lý do từ chối') }}
												</label>
												<x-input name="reason" id="reason" :value="old('reason')"
													placeholder="{{ __('Nhập lý do từ chối') }}" />
											</div>

											<div class="d-flex justify-content-end gap-2 pt-2">
												<button type="button" class="btn btn-outline-secondary"
													data-bs-dismiss="modal">
													{{ __('Hủy') }}
												</button>
												<button type="submit" class="btn btn-danger">
													<i class="ti ti-ban me-1"></i> {{ __('Từ chối') }}
												</button>
											</div>
										</x-form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('libs-js')
	<!-- button in datatable -->
	<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>
@endpush

@push('custom-js')
	{{ $dataTable->scripts() }}

	@include('admin.hotel.hotel_approval.scripts.datatable')
@endpush